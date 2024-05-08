<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;
protected $fillable=[
    'name'
];
    protected $hidden =[
        'created_at',
        'updated_at'

    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'courses_tags', 'tag_id', 'course_id');
    }
}
