<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use App\Models\Timetable;

use PDOException;
use Ramsey\Uuid\Type\Time;

class RegisterController extends Controller
{
    //時間割登録API
    // POST ex) http://localhost:8000/api/timetablesCreate
    public function createTimetables(Request $request)
    {
        // $timetables = new Timetable();
        // echo $timetables;
        // $timetables->teacher_name = '山田';
        // echo $timetables;
        // echo $request;
        echo $request->time->subject;

        // $post = new Timetable();
        // $post->time->subject = $request->time->subject;
        // $post->lessons = $request->lessons;

        // $post->period = 3;
        // $post->subject = '国語';
        // $post->teacher_name = '佐藤';
        // $post->start_date = '2023-05-05';
        // $post->end_date = '2023-05-06';

        // $post->save();
        // echo $post;

        // DB::insert('insert into reviews (day_of_week) values (:day_of_week)', $param);

        $message = [
            'messages' => [
                'success'
                // その他のパターン例
                // 'failure'
                // 'validationError',
                // '教師を入力した場合、科目は必須項目です。月曜3時間目の科目を入力してください。'
            ]
        ];

        return Response::json($message);
    }
}
