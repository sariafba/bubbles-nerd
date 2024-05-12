<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TagController;
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
    Route::get('/getByUser/{id}',     [CourseController::class,'getByUser']);

    Route::get('/getWithUser/{id}',     [CourseController::class,'getWithUser']);
    Route::get('/getWithLesson/{id}',     [CourseController::class,'getWithLesson']);
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

Route::group(['prefix'=>'tag'], function () {
    Route::get('/index',   [TagController::class,'index']);
    Route::get('/getById/{id}',     [TagController::class,'getById']);
    Route::delete('/delete/{id}',[TagController::class,'delete']);
    Route::get('/getTagWithCourse/{name}',     [TagController::class,'getTagWithCourse']);
});

Route::group(['prefix'=>'subject'], function () {
    Route::get('/getBySubject/{id}',     [SubjectController::class,'getBySubject']);
});
Route::group(['prefix'=>'comment'], function () {
    Route::get('/index',   [CommentController::class,'index']);
    Route::get('/getById/{id}',     [CommentController::class,'getById']);
    Route::post('/create',[CommentController::class,'create']);
    Route::post('/update/{id}',[CommentController::class,'update']);
    Route::delete('/delete/{id}',[CommentController::class,'delete']);
});
