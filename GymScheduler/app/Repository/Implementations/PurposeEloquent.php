<?php

namespace App\Repository\Implementations;

use App\Models\Purpose;  

class PurposeEloquent extends EloquentImplementation {

  public function __construct(Purpose $purpose) {
    parent::__construct($purpose);
  }

}