<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;

use App\Models\Teacher;

class PostTeacherController extends Controller
{
    // 教師ログインAPI
    public const TOKEN_NAME = 'app_api_token';
    public function __invoke(Request $request)
    {
        $message = [];
        $token = [];

        // バック側バリデーションチェック
        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|between:8,255',
        ]);

        // バリデーションが通った場合の処理
        // DBのemailと一致するデータがあるか
        $user = Teacher::where('email', $validated['email'])->first();
        if ($user && Hash::check($validated['password'], $user->password)) {
            // データベースにユーザーが存在して、パスワードが一致する時の処理
            // APIトークンの発行
            $token = [
                'accessToken' => $user->createToken(self::TOKEN_NAME)->plainTextToken
            ];

            // テーブルのAPIトークン更新
            $user->api_token = $token['accessToken'];
            $user->save();

            // message success & APIトークン送信
            $message = [
                'messages' => [
                    'success'
                ]
            ];
        } else {
            // email or pass fuilure
            $message = [
                'messages' => [
                    'fuilure'
                ]
            ];
        }

        return Response::json($message);
    }
}
