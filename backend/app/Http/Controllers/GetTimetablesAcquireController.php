<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;


class GetTimetablesAcquireController extends Controller
{
    //
    public function getTimetables(Request $request)
    {
        $date = $request->date;

        //responseの用意
        $timetables = [];
        $filtered_timetables = collect();

        //基準となる月曜日を変数に
        $dateMonday = $date;

        //年だけ取得
        $holidaydDataYear = explode("-", ($date))[0];

        //月曜の年の祝日データを取る
        $YearHolidayDatas = $this->getHolidays($holidaydDataYear);

        //7回繰り返すfor文
        //for文のループ変数の0で月曜、6で日曜を処理
        for ($loopWeekCount = 0; $loopWeekCount < 7; $loopWeekCount++) {
            $setData = [];
            $getDate = date("Y-m-d", strtotime("$dateMonday $loopWeekCount day"));
            $setData['date'] = $getDate;
            $getDateYear = explode("-", ($getDate))[0];

            //年が異なるかの判定
            if ($holidaydDataYear !== $getDateYear) {

                //新しい祝日データ取得
                $YearHolidayDatas = $this->getHolidays($getDateYear);
                $holidaydDataYear = $getDateYear;
            }

            //祝日判定
            if (array_key_exists($getDate, $YearHolidayDatas)) {
                //祝日のとき
                $setData['isHoliday'] = true;
                $setData['holidayTitle'] = $YearHolidayDatas[$getDate];
            } else {
                $setData['isHoliday'] = false;
            }

            //日曜判定
            if ($loopWeekCount === 6) {
                //日曜のとき
                $setData['dayOfWeek'] = 0;
                $getDbData = DB::table('timetables')->where('start_date', '<=', $getDate)
                    ->where('end_date', '>=', $getDate)->where('day_of_week', '=', 0)->get();
            } else {
                $setData['dayOfWeek'] = $loopWeekCount + 1;
                $getDbData = DB::table('timetables')->where('start_date', '<=', $getDate)
                    ->where('end_date', '>=', $getDate)->where('day_of_week', '=', $loopWeekCount + 1)->get();
            }

            //isHoliday false判定
            if (!($setData['isHoliday'])) {
                //時間割用の配列用意
                $setData['lessons'] = array();
            }

            array_push($timetables, $setData);

            //曜日ごとのデータをcollectionにmergeしていく
            $filtered_timetables = collect($filtered_timetables)->merge($getDbData);
        }

        //DB関連処理
        //rankedtimetable:rankの代わりにcreated_atでsortdesc
        $ranked_timetable = $filtered_timetables->sortByDesc('created_at');

        //収納時に利用する変数設定
        $timetableCount = 0;

        //timetablesのforeach文で月曜から日曜の1~6まで繰り返す。
        foreach ($timetables as $timetable) {
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
            $timetableCount++;
        }
        return Response::json($timetables);
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
}
