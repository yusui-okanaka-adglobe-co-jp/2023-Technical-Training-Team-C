<?php

use App\Http\Controllers\GetTimetablesAcquireController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MockController;
use App\Http\Controllers\PostTeacherController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;

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
// Route::get('/timetablesAcquire', [MockController::class, 'getTimetables']);
// Route::post('/timetablesCreate', [MockController::class, 'createTimetables']);
// Route::post('/teachersLogin', [MockController::class, 'loginTeachers']);

// 本番用(モック用はコメントアウトにする)
Route::get('/timetablesAcquire', [GetTimetablesAcquireController::class, 'getTimetables']);
Route::post('/timetablesCreate', [RegisterController::class, 'createTimetables']);
Route::post('/teachersLogin', PostTeacherController::class);
Route::get('/auth', AuthController::class);
Route::get('/logout', LogoutController::class);
