<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;

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


Route::group(['prefix'=>'course'], function () {
    Route::get('/index',   [CourseController::class,'index']);
    Route::get('/show/{id}',     [CourseController::class,'getById']);
    Route::post('/create',[CourseController::class,'create']);
    Route::put('/update/{id}',[CourseController::class,'update']);
    Route::delete('/delete/{id}',[CourseController::class,'delete']);

});
