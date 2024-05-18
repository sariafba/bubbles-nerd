<?php

namespace App\Http\Controllers;

use App\Http\Requests\comment\StoreCommentRequest;
use App\Http\Requests\comment\UpdateCommentRequest;
use App\Services\CommentService;

class CommentController extends Controller
{

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
        $this->middleware(['auth:api'])->only('create');

    }


    public function index()
    {
        return $this->commentService->index();
    }


    public function getById(int $id)
    {
        return $this->commentService->getById($id);
    }

    public function getLessonWithComment(int $id)
    {
        return $this->commentService->getLessonWithComment($id);
    }

    public function create(StorecommentRequest $data)
    {
        return $this->commentService->create($data->safe()->all());
    }


    public function update(UpdatecommentRequest $data, $id)
    {
        return $this->commentService->update($data->safe()->all(), $id);
    }


    public function delete(int $id)
    {
        return $this->commentService->delete($id);
    }
}
