<?php

namespace App\Repositories;

use App\Exceptions\FailedException;
use App\Models\Course;
use App\Models\Rating;
use App\Traits\ResponseTrait;
use App\Traits\StorePhotoTrait;
use Exception;
use http\Env\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

Class RatingRepository implements RatingRepositoryInterface
{
    use ResponseTrait;
    use StorePhotoTrait;

    protected Rating $rating;

    public function __construct(Rating $rating)
    {
        $this->rating = $rating;
    }

    public function index()
    {
        return $this->rating->get();
    }

    public function sumRatingsForCourse(int $id)
    {

        $sumOfRatings = Rating::where('course_id', $id)->sum('rating');
        $countOfRatings = Rating::where('course_id', $id)->count();

        if ($countOfRatings > 0) {
            $averageRating = $sumOfRatings / $countOfRatings;
            $scaledRating = round($averageRating * 2, 1);

            return  "$scaledRating/10";

        }

        }

    public function create(array $data)
    {
        $existingRating = Rating::where('user_id', auth()->id())
            ->where('course_id', $data['course_id'])
            ->first();
        if ($existingRating) {

        return response('u already rate this course',400);}

        try {
            DB::beginTransaction();
            $rating = new $this->rating;
            $rating->rating = $data['rating'];
            $rating->course_id = $data['course_id'];
            $rating->user_id=Auth::id();
            $rating->save();
            DB::commit();
            return $rating->fresh();
        } catch (Exception $e) {
            DB::rollBack();
            throw new FailedException("Unable to rate " . $e->getMessage());
        }
    }


}
