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
        'validated_hours_in_minutes',
    ];

    public function getValidatedHoursAttribute($value)
    {
        if ($this->validated_hours_in_minutes == null) {
            return null;
        }

        return str_pad(intdiv($this->validated_hours_in_minutes, 60), 2, '0', STR_PAD_LEFT) . ':' . str_pad(($this->validated_hours_in_minutes % 60), 2, '0', STR_PAD_LEFT);
    }

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
