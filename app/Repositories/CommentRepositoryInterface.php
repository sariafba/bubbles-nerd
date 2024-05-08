<?php

namespace App\Repositories;

interface CommentRepositoryInterface
{
    public function index();
    public function getById(int $id);
    public function create(array $data);
    public function update(array $data, int $id);
    public function delete(int $id);

}
