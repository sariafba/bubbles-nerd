<?php

namespace App\Repositories;

use App\Exceptions\FailedException;
use App\Exceptions\NotFoundException;
use App\Models\Comment;
use App\Models\Commentable;
use App\Models\Lesson;
use App\Models\Tag;
use App\Traits\ResponseTrait;
use App\Traits\StoreVideoTrait;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

Class CommentRepository implements CommentRepositoryInterface
{
    use ResponseTrait;
    use StoreVideoTrait;

    protected comment $comment;

    public function __construct(comment $comment)
    {
        $this->comment = $comment;
    }

    public function index()
    {
        return $this->comment->get();
    }

    public function getById(int $id)
    {
        $comment = $this->comment->where('id', $id)->get();

        if (!$comment) {
            throw new NotFoundException();
        }
        return $comment;
    }

    public function getLessonWithComment(int $id)
    {
        $lesson = Lesson::with([
            'comments.user:id,name,avatar',
            'comments' => function ($query) {
                $query->withCount('reply');
            }
        ])->find($id);

        if (!$lesson) {
            throw new NotFoundException();
        }

        return $lesson;
    }

    public function create(array $data)
    {
        try {
            DB::beginTransaction();


            $comment = new Comment();
            $comment->comment = $data['comment'];
            $comment->user_id = Auth::id();
            $comment->save();


            if (isset($data['lesson_id'])) {
                $commentableType = 'App\Models\Lesson';
                $commentableId = $data['lesson_id'];}

            if (isset($data['video_id'])) {
                $commentableType = 'App\Models\Video';
                $commentableId = $data['video_id'];}



            $commentable = $commentableType::find($commentableId);
            if ($commentable) {
                $commentable->comments()->save($comment);
            } else {
                throw new Exception("Commentable entity not found.");
            }

            DB::commit();

            return $comment->fresh();
        } catch (Exception $e) {
            DB::rollBack();
            throw new FailedException("Unable to create comment: " . $e->getMessage());
        }
    }


    public function update(array $data, int $id)
    {
        try{
            DB::beginTransaction();
            $comment = $this->comment->find($id);

            if (!$comment) {
                throw new NotFoundException();
            }
            $comment = new $this->comment;
            $comment->comment=$data['comment']??$comment->commemt;
            $comment->lesson_id=$data['lesson_id']??$comment->lesson_id;
            $comment->user_id = Auth::id()??$comment->user_id;
            $comment->save();

            DB::commit();

            return $comment->fresh();
        }

        catch(Exception $e){
            DB::rollBack();
            throw new FailedException(("Unable to update comment: "). $e->getMessage());

        }
    }

    public function delete(int $id)
    {
        $comment = $this->comment->find($id);

        if (!$comment) {
            throw new NotFoundException();
        }
        $comment->delete();

        return $comment;
    }

}
