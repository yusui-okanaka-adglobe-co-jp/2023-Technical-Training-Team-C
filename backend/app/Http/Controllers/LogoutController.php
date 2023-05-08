<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LogoutController extends Controller
{
    //ページ遷移の処理
    public function __invoke(Request $request)
    {
        // Cookieの削除
        Cookie::queue(Cookie::forget('api_token'));

        return;
    }
}
