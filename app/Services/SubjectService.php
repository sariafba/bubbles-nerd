<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Models\subject;
use App\Traits\ResponseTrait;

class SubjectService
{
    use ResponseTrait;
    protected  subject $subject;

    public function __construct(subject $subject)
    {
        $this->subject = $subject;
    }
    public function getBySubject(int $subjectId)
    {
        $subject = Subject::with('teachers')->findOrFail($subjectId);
        if (!$subject) {
            throw new NotFoundException();
        }
        return $this->successWithData($subject,'Operation completed',200);
    }
}
