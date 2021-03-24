<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type_situation_id',
        'axle_id',
        'title',
        'description',
        'archive',
        'observation',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function typeSituation()
    {
        return $this->belongsTo(TypeSituation::class);
    }

    public function axle()
    {
        return $this->belongsTo(Axle::class);
    }
}
