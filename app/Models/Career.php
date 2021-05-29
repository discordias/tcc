<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function CourseCurricula()
    {
        return $this->hasMany(CourseCurriculum::class);
    }

    public function validators()
    {
        return $this->belongsToMany(User::class, 'validator_careers', 'career_id', 'user_id');
    }
}
