<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\AuthController;
use App\Models\Member;
use App\Http\Controllers\MembersController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('members', [MembersController::class, 'index'])->middleware('auth:sanctum');

Route::get('members/{member}', [MembersController::class, 'show'])->middleware('auth:sanctum');

Route::put('members/{member}', [MembersController::class, 'update']);//->middleware('auth:sanctum');

Route::delete('members/{member}', [MembersController::class, 'delete'])->middleware('auth:sanctum');

Route::post('images', [ImagesController::class, 'create'])->middleware('auth:sanctum');

Route::get('images', [ImagesController::class, 'index'])->middleware('auth:sanctum');

Route::delete('images/{image}', [ImagesController::class, 'delete'])->middleware('auth:sanctum');
