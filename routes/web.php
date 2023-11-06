<?php

use App\Services\PusherEvents;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('login', [AuthController::class, 'login']);

Route::get('logout', [AuthController::class, 'logout']);


Route::get('/', function () {
    return view('welcome');
});

Route::get('/pusher', function () {
    return view('pusher');
});

Route::get('/greetings', function () {
    broadcast(new PusherEvents('hello world'));

    return 'Hello world message has been triggered';
    //return __('message.fee_notice');
});
