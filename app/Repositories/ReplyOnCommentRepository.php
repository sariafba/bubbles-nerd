<?php

namespace App\Repositories;

use App\Exceptions\FailedException;
use App\Exceptions\NotFoundException;
use App\Models\Comment;
use App\Models\ReplyOnComment;
use App\Models\Lesson;
use App\Models\Tag;
use App\Traits\ResponseTrait;
use App\Traits\StoreVideoTrait;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

Class ReplyOnCommentRepository implements ReplyOnCommentRepositoryInterface
{
    use ResponseTrait;
    use StoreVideoTrait;

    protected ReplyOnComment $ReplyOnComment;

    public function __construct(ReplyOnComment $ReplyOnComment)
    {
        $this->ReplyOnComment = $ReplyOnComment;
    }

    public function index()
    {
        return $this->ReplyOnComment->get();
    }

    public function getById(int $id)
    {
        $ReplyOnComment = $this->ReplyOnComment->where('id', $id)->get();

        if (!$ReplyOnComment) {
            throw new NotFoundException();
        }
        return $ReplyOnComment;
    }

    public function getReplyOnComment(int $id)
    {
        $comment = Comment::with('reply.user:id,name,avatar')->find($id);

        if (!$comment) {
            throw new NotFoundException();
        }

        return $comment;
    }

    public function create(array $data)
    {
        try {
            DB::beginTransaction();

            $ReplyOnComment = new ReplyOnComment();
            $ReplyOnComment->reply = $data['reply'];
            $ReplyOnComment->comment_id = $data['comment_id'];
            $ReplyOnComment->user_id = Auth::id();
            $ReplyOnComment->save();

            DB::commit();

            return $ReplyOnComment->fresh();
        } catch (Exception $e) {
            DB::rollBack();
            throw new FailedException("Unable to create ReplyOnComment: " . $e->getMessage());
        }
    }


    public function delete(int $id)
    {
        $ReplyOnComment = $this->ReplyOnComment->find($id);

        if (!$ReplyOnComment) {
            throw new NotFoundException();
        }
        $ReplyOnComment->delete();

        return $ReplyOnComment;
    }

}
