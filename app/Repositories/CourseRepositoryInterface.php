<?php

namespace App\Repositories;

interface CourseRepositoryInterface
{
    public function index();

    public function getById(int $id);

    public function create(array $data);

    public function update(array $data, int $id);

    public function delete(int $id);

    public function getByUser(int $userId);

    public function getWithUser(int $id);

    public function getWithLesson(int $id);

    public function searchForCourse($name);

    public function getByUSerAndSubject( int $userId, int $subjectId);

}
