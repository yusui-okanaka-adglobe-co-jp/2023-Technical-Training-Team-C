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
        $validated = $request->validate([
            'time.start' => 'required|date_format:"Y-m-d"',
            'time.end' => 'required|date_format:"Y-m-d"',
            'lessons' => 'required|array',
            'lessons.*.subject' => 'required_with:lessons.*.subject|string|max:10',
            'lessons.*.teacher' => 'required_with:lessons.*.teacher|string|max:10',
            'lessons.*.dayOfWeek' => 'required_with:lessons.*.dayOfWeek|min:0|max:6',
            'lessons.*.period' => 'required_with:lessons.*.period|min:1|max:6'
        ]);


        $start = $request->input('time.start');
        $end = $request->input('time.end');
        $lessons = $request->collect('lessons');

        foreach ($lessons as $i => $class) {
            $post = new Timetable();
            $post->start_date = $start;
            $post->end_date = $end;
            $dayOfWeek = $lessons[$i]['dayOfWeek'];
            $period = $lessons[$i]['period'];
            $subject = $lessons[$i]['subject'];
            $teacher = $lessons[$i]['teacher'];
            $post->day_of_week = $dayOfWeek;
            $post->period = $period;
            $post->subject = $subject;
            $post->teacher_name = $teacher;
            $post->save();
        }
        if ($start && $end && $lessons) {
            $message = [
                'messages' => [
                    'success'
                    // その他のパターン例
                    // 'failure'
                    // 'validationError',
                    // '教師を入力した場合、科目は必須項目です。月曜3時間目の科目を入力してください。'
                ]
            ];
        } else {

            $message = [
                'messages' => [
                    'failure'
                ]
            ];
        }
        return Response::json($message);
    }
}
