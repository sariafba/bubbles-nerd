<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Video extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'description',
        'video'
    ];
    protected $hidden=[
        'created_at',
        'updated_at'
    ];
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
    public function comments(): morphToMany
    {
        return $this->morphToMany(Comment::class, 'commentable');
    }
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
    public function userLike()
    {
        return $this->morphOne(Like::class, 'likeable')
            ->where('user_id', auth()->id());
    }
}
