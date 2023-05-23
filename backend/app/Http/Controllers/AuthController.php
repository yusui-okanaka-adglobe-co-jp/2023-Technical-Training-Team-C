<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Teacher;

class AuthController extends Controller
{
    //API認証用コントローラ
    public function __invoke(Request $request)
    {
        // Cookieの取得
        $cookieValue = Cookie::get('api_token');
        // Teacherテーブルのトークン取得
        $user = Teacher::where('api_token', $cookieValue)->first();
        $response = "";
        // CookieとDBのトークン比較
        if($user) {
            // 正しい場合
            $response = "success";
        } else {
            // エラー処理
            $response = "failure";
        }
        return ($response);
    }
}
