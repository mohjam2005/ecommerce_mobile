<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class permissions extends Model
{
    protected $fillable = [
        'name',
        'guard_name'
    ];

  
  
}
