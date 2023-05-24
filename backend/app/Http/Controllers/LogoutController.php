<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LogoutController extends Controller
{
    //ログアウト処理
    public function __invoke(Request $request)
    {
        // Cookieの削除
        $response = response();
        // $response->cookie('api_token', '', 0, '/');
        Cookie::queue(Cookie::forget('api_token'));

        // $response->cookie('api_token');
        // レスポンスを返す
        return $response;
        // setcookie('api_token', '', 0, '/');

        // return $response;
    }
}
