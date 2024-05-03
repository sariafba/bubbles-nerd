<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'old_price',
        'photo',
        'description',
        'user_id',
        'subject_id'
    ];

    protected $hidden=[
        'created_at',
        'updated_at'
    ];
    public function users(): HasMany
    {
        return $this->hasMany(Course::class);
    }
    public function unit(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
