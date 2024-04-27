<?php

namespace App\Repositories;
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
            $course->subjects_id =$data['subject_id'];
            if (isset($data['photo'])) {
                $course->photo = $this->store($data['photo'], 'Course_photos');
            }else{
                $course->photo =null;
            }
            $course->save();


            return $course->fresh();
        }catch(Exception $e){
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


