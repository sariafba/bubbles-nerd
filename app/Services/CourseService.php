<?php

namespace App\Services;

use App\Exceptions\CourseCreatinoException;
use App\Exceptions\courseNotFoundException;
use App\Exceptions\CourseUpdateException;
use App\Repositories\CourseRepositoryInterface;
use App\Repositories\CourseRepository;
use App\Traits\ResponseTrait;
use http\Client\Request;

class CourseService
{
    use ResponseTrait;

    protected CourseRepositoryInterface $courseRepository;

    public function __construct(CourseRepositoryInterface $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }
    public function index(){
        $data = $this->courseRepository->index();

        return $this->successWithData($data, 'operation completed', 200);
    }

    public function getById(int $id)
    {
        try {
            $data = $this->courseRepository->getById($id);
            return $this->successWithData($data,  'Operation completed',200);
        } catch (courseNotFoundException $e) {
            return $this->failed($e->getMessage(), 404);
        }
    }

    public function create( Request $data)
    {
        try {
            $course = $this->courseRepository->create($data->only( 'name', 'price', 'old_price', 'photo', 'description'));

            return $this->successWithData($course, 'created successfully',201);
        }catch (courseCreatinoException $e) {
            return $this->failed($e->getMessage(), 404);}
    }

    public function update(Request $data, int $id)
    {
        try {
            $course = $this->courseRepository->update($data->only('name', 'price', 'old_price', 'photo', 'description'), $id);

            return $this->successWithData($course, 'updated successfully',201);
        } catch (courseCreatinoException $e) {
            return $this->failed($e->getMessage(), 404);
        }catch (CourseUpdateException $e) {
            return $this->failed($e->getMessage(), 422);}
    }

    public function delete(int $id)
    {
        try {
            $this->courseRepository->delete($id);
            return $this->successWithData('','course deleted successfully',200);
        } catch (CourseNotFoundException $e) {
            return $this->failed($e->getMessage(), 404);
    }
}

}
