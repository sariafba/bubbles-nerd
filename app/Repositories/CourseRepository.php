<?php

namespace App\Repositories;
use App\Exceptions\NotFoundException;
use App\Models\Lesson;
use App\Models\Subject;
use App\Models\Tag;
use App\Models\User;
use Exception;
use App\Exceptions\CourseCreatinoException;
use App\Exceptions\CourseUpdateException;
use App\Exceptions\courseNotFoundException;
use App\Models\Course;
use App\Traits\ResponseTrait;
use App\Traits\StorePhotoTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseRepository implements CourseRepositoryInterface
{
    use ResponseTrait;
    use StorePhotoTrait;
    protected  Course $course;

    public function __construct(Course $course)
    {
        $this->course = $course;
    }
    public function index()
    {
    return $this->course->get();
    }

    public function getById(int $id)
    {
        $course =  $this->course->where('id', $id)->get();

        if (!$course) {
            throw new courseNotFoundException();
        }
        return $course;

    }

    public function getByUser(int $userId)
    {

        $user = User::with('courses')->where('id', $userId)->first();
        return $user;
    }

    public function getWithUser(int $id)
{
    $course=$this->course->with('user')->where('id', $id)->first();;

    return $course;
}

    public function getWithLesson(int $id)
    {

        $course=$this->course->with('lessons')->where('id', $id)->first();
        return $course;
    }
    public function create(array $data)
    {
        try{
            DB::beginTransaction();
            $course = new $this->course;
            $course->name = $data['name'];
            $course->price = $data['price'];
            $course->old_price = $data['old_price'];
            $course->description = $data['description'];
            $course->user_id = Auth::id();
            $course->subject_id =$data['subject_id'];
            if (isset($data['photo'])) {
                $course->photo = $this->store($data['photo'], 'Course_photos');
            }else{
                $course->photo =null;
            }

            $course->save();

             preg_match_all('/#(\w+)/', $course->description, $matches);
        $tag = collect($matches[1]);

        $tag->each(function ($tag) use ($course) {
            $tagModel= Tag::firstOrCreate(['name' => $tag]);
            $course->tags()->attach($tagModel->id);
        });



            DB::commit();
            return $course->fresh();
        }catch(Exception $e){
            DB::rollBack();
            throw new CourseCreatinoException(("Unable to create course: "). $e->getMessage());

        }
    }

    public function update(array $data, int $id)
    {

        try{
            DB::beginTransaction();
            $course = $this->course->find($id);

            if (!$course) {
                throw new courseNotFoundException();
            }

            $course->name = $data['name']?? $course->name;;
            $course->price = $data['price']??$course->price;
            $course->old_price = $data['old_price']??$course->old_price;
            $course->description = $data['description']??$course->description;
            $course->user_id = Auth::id()??$course->user_id;
           // $course->subjects_id =$data['subject_id'];
            if (isset($data['photo'])) {
                $course->photo = $this->store($data['photo'], 'Course_photos');
            }
            $course->save();

            DB::commit();
            return $course->fresh();
        }catch(Exception $e){
            DB::rollBack();
            throw new courseUpdateException(("Unable to update course: "). $e->getMessage());

        }
    }

    public function delete(int $id)
    {
        $course = $this->course->find($id);

        if (!$course) {
            throw new CourseNotFoundException();
        }
        $course->delete();

        return $course;
    }
}


