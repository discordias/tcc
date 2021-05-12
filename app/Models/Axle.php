<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Axle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function courseCurricula()
    {
        return $this->belongsToMany(CourseCurriculum::class)->withTimestamps();
    }
}
