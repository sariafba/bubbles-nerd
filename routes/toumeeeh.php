<?php

use App\Http\Controllers\LessonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ResetCodePasswordController;
use App\Http\Controllers\UnitController;



Route::group(['prefix'=>'course'], function () {
    Route::get('/index',   [CourseController::class,'index']);
    Route::get('/getById/{id}',     [CourseController::class,'getById']);
    Route::post('/create',[CourseController::class,'create']);
    Route::post('/update/{id}',[CourseController::class,'update']);
    Route::delete('/delete/{id}',[CourseController::class,'delete']);
});

    Route::group(['prefix'=>'ResetCodePassword'], function () {
    Route::post('ForgotPassword',  [ResetCodePasswordController::class,'ForgotPassword']);
    Route::post('CodeCheck', [ResetCodePasswordController::class,'CodeCheck']);
    Route::post('ResetPassword', [ResetCodePasswordController::class,'ResetPassword']);
});
    Route::group(['prefix'=>'unit'], function () {
    Route::get('/index',   [UnitController::class,'index']);
    Route::get('/getById/{id}',     [UnitController::class,'getById']);
    Route::post('/create',[UnitController::class,'create']);
    Route::post('/update/{id}',[UnitController::class,'update']);
    Route::delete('/delete/{id}',[UnitController::class,'delete']);
});

Route::group(['prefix'=>'lesson'], function () {
    Route::get('/index',   [lessonController::class,'index']);
    Route::get('/getById/{id}',     [lessonController::class,'getById']);
    Route::post('/create',[lessonController::class,'create']);
    Route::post('/update/{id}',[lessonController::class,'update']);
    Route::delete('/delete/{id}',[lessonController::class,'delete']);
});
