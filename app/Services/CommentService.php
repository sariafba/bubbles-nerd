<?php

namespace App\Services;

use App\Exceptions\FailedException;
use App\Exceptions\NotFoundException;
use App\Exceptions\UpdateException;
use App\Repositories\CommentRepositoryInterface;
use App\Traits\ResponseTrait;
use Illuminate\Support\Arr;

class CommentService
{
    use ResponseTrait;
    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->CommentRepository = $commentRepository;
    }
    public function index(){
        $data = $this->CommentRepository->index();

        return $this->successWithData($data, 'operation completed', 200);
    }

    public function getById(int $id)
    {
        try {
            $data = $this->CommentRepository->getById($id);
            return $this->successWithData($data,  'Operation completed',200);
        } catch (NotFoundException $e) {
            return $this->failed($e->getMessage(), 404);
        }
    }

    public function create( array $data)
    {
        try {

            $comment = $this->CommentRepository->create(Arr::only($data,[ 'comment','user_id','lesson_id']));

            return $this->successWithData($comment, 'created successfully',201);
        }catch (FailedException$e) {
            return $this->failed($e->getMessage(), 400);}
    }

    public function update(array $data, int $id)
    {
        try {
            $comment = $this->CommentRepository->update(Arr::only($data,[  'comment','user_id','lesson_id']),$id);

            return $this->successWithData($comment, 'updated successfully',201);

        }catch (UpdateException $e) {
            return $this->failed($e->getMessage(), 400);}
    }

    public function delete(int $id)
    {
        try {
            $this->CommentRepository->delete($id);
            return $this->successWithData('','comment deleted successfully',200);
        } catch (NotFoundException $e) {
            return $this->failed($e->getMessage(), 404);
        }
    }

}
