<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterPostRequest;
use Illuminate\Support\Facades\Response;
use App\Models\Timetable;

class RegisterController extends Controller
{
    //時間割登録API
    // POST ex) http://localhost:8000/api/timetablesCreate
    public function createTimetables(RegisterPostRequest $request)
    {
        //バリデーションチェック
        $validated = $request->validate([]);

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
