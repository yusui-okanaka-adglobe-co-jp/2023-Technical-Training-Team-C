<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MockController;
use App\Http\Controllers\PostSanctumTokenController;
use App\Http\Controllers\GetFirstController;
use App\Http\Controllers\PostTeacherController;
use App\Http\Requests\PostTeacherRequest;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/sample", function (Request $request) {
    // 本当はちゃんと Contoroller クラスを作ってそこに書くべき
    $now = new DateTime("now", new DateTimeZone("Asia/Tokyo"));
    return [
        "timestamp" => $now->format(DateTimeInterface::ISO8601_EXPANDED),
        "message" => empty($request->name) ? "What is your name?" : "Hello, {$request->name} san!!"
    ];
});

// モック用
Route::get('/timetablesAcquire', [MockController::class, 'getTimetables']);
Route::post('/timetablesCreate', [MockController::class, 'createTimetables']);
// Route::post('/teachersLogin', [MockController::class, 'loginTeachers']);

// api認証テスト用
Route::post('/sanctum/token', PostSanctumTokenController::class);
Route::get('/first', GetFirstController::class)->middleware('auth:sanctum');

// 本番用(モック用はコメントアウトにする)
Route::post('/teachersLogin', PostTeacherController::class);
