<?php

namespace App\Repositories;

use App\Exceptions\FailedException;
use App\Models\Course;
use App\Models\Rating;
use App\Traits\ResponseTrait;
use App\Traits\StorePhotoTrait;
use Exception;
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

        return $sumOfRatings;
    }

    public function create(array $data)
    {
        try {
            DB::beginTransaction();
            $rating = new $this->rating;
            $rating->rating = $data['rating'];
            $rating->course_id = $data['course_id'];
            $rating->save();
            DB::commit();
            return $rating->fresh();
        } catch (Exception $e) {
            DB::rollBack();
            throw new FailedException("Unable to rate: " . $e->getMessage());
        }
    }
}
