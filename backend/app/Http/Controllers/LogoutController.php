<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LogoutController extends Controller
{
    //ログアウト処理
    public function __invoke(Request $request)
    {
        $response = response()->json([]);
        // Cookieの削除
        // setcookie('api_token', '', 0,'/');
        $response->cookie('api_token', 'deleted', 60 * 24 * 30);

        return $response;
    }
}
