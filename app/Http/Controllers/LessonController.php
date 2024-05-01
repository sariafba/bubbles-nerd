<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;

class LessonController extends Controller
{

    public function index()
    {
        //
    }


    public function create(StoreLessonRequest $request)
    {
        //
    }





    public function update(UpdateLessonRequest $request, Lesson $lesson)
    {
        //
    }


    public function destroy(Lesson $lesson)
    {
        //
    }
}
