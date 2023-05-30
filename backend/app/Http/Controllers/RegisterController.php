<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterPostRequest;
use Illuminate\Support\Facades\Response;
use App\Models\Timetable;
use Exception;

class RegisterController extends Controller
{
    //時間割登録API
    // POST ex) http://localhost:8000/api/timetablesCreate
    public function createTimetables(RegisterPostRequest $request)
    {
        try {
            $start = $request->input('time.start');
            $end = $request->input('time.end');
            $lessons = $request->collect('lessons');

            foreach ($lessons as $class) {
                $post = new Timetable();
                $post->start_date = $start;
                $post->end_date = $end;
                $dayOfWeek = $class['dayOfWeek'];
                $period = $class['period'];
                $subject = $class['subject'];
                $teacher = $class['teacher'];
                $isClear = $class['isClear'];
                if ($isClear === true) {
                    $subject = '';
                    $teacher = '';
                }
                $post->day_of_week = $dayOfWeek;
                $post->period = $period;
                $post->subject = $subject;
                $post->teacher_name = $teacher;
                $post->save();
            }

            $message = [
                'messages' => [
                    'success'
                ]
            ];
        } catch (Exception $e) {
            $message = [
                'messages' => [
                    'failure'
                ]
            ];
        } finally {
            return Response::json($message);
        }
    }
}
