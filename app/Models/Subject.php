<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    /**
     * RELATIONS
     *
     */
    public function teachers()
    {
        return $this->belongsToMany(User::class, 'teachers_has_subjects');
    }
}
