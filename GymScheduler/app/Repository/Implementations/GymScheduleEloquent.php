<?php

namespace App\Repository\Implementations;

use App\Models\GymSchedule;  

class GymScheduleEloquent extends EloquentImplementation {

  public function __construct(GymSchedule $schedule) {
    parent::__construct($schedule);
  }

}