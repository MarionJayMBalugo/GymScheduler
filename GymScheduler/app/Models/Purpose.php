<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purpose extends Model
{
    protected $fillable = [
        'name',
        'color'
    ];
    public function gym_schedules() {
        return $this->hasMany(GymSchedule::class);
    }
}
