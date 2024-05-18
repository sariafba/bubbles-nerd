<?php

namespace App\Repositories;

interface ReplyOnCommentRepositoryInterface
{
    public function index();
    public function getById(int $id);
    public function create(array $data);
    public function delete(int $id);
    public function getReplyOnComment(int $id);
}
