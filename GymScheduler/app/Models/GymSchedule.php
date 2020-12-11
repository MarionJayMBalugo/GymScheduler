<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GymSchedule extends Model
{
    protected $table = 'gym_schedules';

    protected $fillable = [
        'user_id',
        'date',
        'renter',
        'purpose_id'
    ];

    public function purpose() {
        return $this->belongsTo(Purpose::class);
    }
}
