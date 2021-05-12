<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseCurriculum extends Model
{
    use HasFactory;

    public function Career()
    {
        return $this->belongsTo(Career::class);
    }

    public function axles()
    {
        return $this->belongsToMany(Axle::class)->withTimestamps();
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
