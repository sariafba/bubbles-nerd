<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $fillable=[
        'rating'
    ];
    protected $hidden=[
        'created_at',
        'updated_at'
    ];
    public function course()
    {
     return $this->belongsTo(Rating::class);
    }
}
