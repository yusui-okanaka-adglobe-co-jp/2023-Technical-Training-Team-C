<?php

namespace App\Http\Controllers;

use App\Models\Timetable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class RegisterController extends Controller
{
    //時間割登録API
    // POST ex) http://localhost:8000/api/timetablesCreate
    public function createTimetables(Request $request)
    {
        echo "a";
        // // $timetables = new Timetable();
        // $timetables->teacher_name = '山田';
        // $timetables->save();
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
