<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Models\Member;

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

Route::get('members', function(){

    $query = Member::where('id', '>', 0);

    if(\request()->has('search')) {
        $searchStr = \request()->get('search');
        $query = $query->where('first_name', 'like', "%{$searchStr}%");
    }

    return $query->paginate(10);
});

Route::post('pictures', [ApiController::class, 'upload']);

Route::get('pictures', [ApiController::class, 'fetchUploadedPicture']);

Route::delete('pictures/{upload}', [ApiController::class, 'delete']);
