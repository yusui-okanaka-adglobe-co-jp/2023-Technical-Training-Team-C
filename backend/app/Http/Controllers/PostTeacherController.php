<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\PostTeacherRequest;
use App\Models\Teacher;

class PostTeacherController extends Controller
{
    // 教師ログインAPI
    public const TOKEN_NAME = 'app_api_token';
    public function __invoke(PostTeacherRequest $request)
    {
        $message = [];
        $token = '';

        // PostTeacherRequestでvalidateされる
        $validated = $request;
        // バリデーションが通った場合の処理
        // DBのemailと一致するデータがあるか
        $user = Teacher::where('email', $validated['email'])->first();
        if ($user && Hash::check($validated['password'], $user->password)) {
            // データベースにユーザーが存在して、パスワードが一致する時の処理
            // APIトークンの発行
            $token = $user->createToken(self::TOKEN_NAME)->plainTextToken;

            // テーブルのAPIトークン更新
            $user->api_token = $token;
            $user->save();

            // message success
            $message = [
                'messages' => [
                    'success'
                ]
            ];
        } else {
            // email or pass failure
            $message = [
                'messages' => [
                    'failure'
                ]
            ];
        }

        // レスポンスを作成する
        $response = response()->json($message);

        // cookieにトークンを持たせる
        $response->cookie('api_token', $token, 60*24*30);

        // レスポンスを返す
        return $response;
    }
}
