<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\StoreCourseRequest;
use App\Http\Requests\Course\UpdateCourseRequest;
use App\Services\CourseService;


class CourseController extends Controller
{
    protected  CourseService $courseService;


    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
        //$this->middleware(['auth:api'])->only('create');

    }


    public function index()
    {
        return $this->courseService->index();
    }


    public function getById(int $id)
    {
        return $this->courseService->getById($id);
    }


    public function create(StoreCourseRequest $request)
    {
        return $this->courseService->create($request);
    }


    public function update(UpdateCourseRequest $request, $id)
    {
        return $this->courseService->update($request,$id);
    }


    public function delete(int $id)
    {
        return $this->courseService->delete($id);
    }
}
