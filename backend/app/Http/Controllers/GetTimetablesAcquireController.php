<?php

namespace App\Http\Controllers;

use App\Models\Timetable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class GetTimetablesAcquireController extends Controller
{
    //main
    public function getTimetables(Request $request)
    {
        $date = $request->date;
        //responseの用意
        $timetables = [];
        $filtered_timetables = collect();
        //比較用
        $today = today();
        $oldestDate = strtotime('20141229');
        $latestDate = strtotime(date("Y", strtotime($today . +1 . ' year')) . '1231');
        //再来年
        $yearAfterNext = date("Y", strtotime($today . +2 . ' year'));

        //dateの型判定
        if (!(preg_match('/\A[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}\z/', $date))) {
            $date = date("Y-m-d", strtotime($today));
        }

        //不正な日付判定
        list($dateYear, $dateMonth, $dateDay) = explode("-", $date);
        if (!(checkdate($dateMonth, $dateDay, $dateYear))) {
            $date = date("Y-m-d", strtotime($today));
        }

        //月曜判定
        $date = $this->setMondayDate($date);

        //年だけ取得
        $holidayDataYear = explode("-", $date)[0];

        if ($holidayDataYear <= '2014' || $holidayDataYear >= $yearAfterNext) {
            $yearHolidayDatas = [];
            //範囲外の場合
            if (strtotime($date) < $oldestDate || $latestDate <= strtotime($date)) {
                //今日のものに変更
                $date = date("Y-m-d", strtotime($today));

                //月曜日判定
                $date = $this->setMondayDate($date);

                //値取り直し
                $holidayDataYear = explode("-", ($date))[0];
                $yearHolidayDatas = $this->getHolidays($holidayDataYear);
            }
        } else {
            //月曜の年の祝日データを取る
            $yearHolidayDatas = $this->getHolidays($holidayDataYear);
        }

        //基準となる月曜日を変数に
        $dateMonday = $date;

        list($filtered_timetables, $timetables) = $this->setDateData($yearAfterNext, $timetables, $dateMonday, $holidayDataYear, $filtered_timetables, $yearHolidayDatas);

        //rankedtimetable:created_atでsortdesc
        $ranked_timetable = $filtered_timetables->sortByDesc('created_at');

        $timetables = $this->setTimetables($ranked_timetable, $timetables);

        return Response::json($timetables);
    }

    //月曜かチェックし、異なった場合は月曜を返却する
    function setMondayDate($date)
    {
        $dateDayOfWeek = date("w", strtotime($date));
        //日曜のときの処理
        if ($dateDayOfWeek === '0') {
            $date = date('Y-m-d', strtotime(-6 . " day", strtotime($date)));
        } else {
            if ($dateDayOfWeek !== '1') {
                $date = date('Y-m-d', strtotime(- ($dateDayOfWeek - 1) . " day", strtotime($date)));
            }
        }
        return $date;
    }


    //holidayAPIに関する処理
    function getHolidays($date)
    {
        $baseUrl = 'https://holidays-jp.github.io/api/v1';
        $dateUrl = 'date.json';
        $url = urldecode("$baseUrl/$date/$dateUrl");
        $response = file_get_contents($url);

        $holidayDatas = json_decode($response, true);
        return $holidayDatas;
    }

    //date関連のtimetablesの設定
    function setDateData($yearAfterNext, $timetables, $dateMonday, $holidayDataYear, $filtered_timetables, $yearHolidayDatas)
    {
        //for文のループ変数の0で月曜、6で日曜を処理
        for ($loopWeekCount = 1; $loopWeekCount <= 7; $loopWeekCount++) {
            $setData = [];
            $getDate = date("Y-m-d", strtotime($dateMonday . $loopWeekCount - 1 . ' day'));
            $setData['date'] = $getDate;
            $getDateYear = explode("-", ($getDate))[0];

            //年が異なるかの判定
            if ($holidayDataYear !== $getDateYear) {
                //取得できない年になってないか確認
                if ($getDateYear <= '2014' || $getDateYear >= $yearAfterNext) {
                    $yearHolidayDatas = [];
                } else {
                    //新しい祝日データ取得
                    $yearHolidayDatas = $this->getHolidays($getDateYear);
                }
                $holidayDataYear = $getDateYear;
            }
            //曜日設定
            $setData['dayOfWeek'] = $loopWeekCount % 7;
            //DBからデータ取得
            $getDBData = $this->getTimetablesFromDB($getDate, $setData['dayOfWeek']);

            //範囲外判定
            if ($getDateYear <= '2014' || $getDateYear >= $yearAfterNext) {
                $setData['isunavailable'] = true;
            } else {
                $setData['isunavailable'] = false;
            }
            //祝日判定
            if (array_key_exists($getDate, $yearHolidayDatas)) {
                //祝日のとき
                $setData['isHoliday'] = true;
                $setData['holidayTitle'] = $yearHolidayDatas[$getDate];
            } else {
                $setData['isHoliday'] = false;
                $setData['lessons'] = array();
            }


            array_push($timetables, $setData);

            //曜日ごとのデータをcollectionにmergeしていく
            $filtered_timetables = collect($filtered_timetables)->merge($getDBData);
        }
        return array($filtered_timetables, $timetables);
    }

    //DBから時間割取得
    function getTimetablesFromDB($getDate, $dayOfWeekNumber)
    {
        $getTimetables = Timetable::where('start_date', '<=', $getDate)
            ->where('end_date', '>=', $getDate)->where('day_of_week', '=', $dayOfWeekNumber)->get();

        return $getTimetables;
    }

    //オブジェクトに時間割を設定する
    function setTimetables($ranked_timetable, $timetables)
    {

        //timetablesのforeach文で月曜から日曜の1~6まで繰り返す。
        foreach ($timetables as $timetableCount => $timetable) {

            //isHolidayがfalseだったら授業データを入れる
            if (!($timetable['isHoliday'])) {
                for ($periodCount = 1; $periodCount < 7; $periodCount++) {
                    //一時間目から順に取得する
                    $getLessonData = $ranked_timetable->where('day_of_week', $timetable['dayOfWeek'])->where('period', $periodCount)->first();

                    //時間割が登録されていないときは空を送る
                    if ($getLessonData == null) {
                        $lesson = [
                            "subject" => "",
                            "teacher" => ""
                        ];
                    } else {
                        $lesson = [
                            "subject" => $getLessonData->subject,
                            "teacher" => $getLessonData->teacher_name
                        ];
                    }
                    array_push($timetables[$timetableCount]['lessons'], $lesson);
                }
            }
        }
        return $timetables;
    }
}
