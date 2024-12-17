<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable=['short_des','description','photo','address','phone','email','logo','branch_id','city_id','country_id'];

    public function vendor()
    {
        return $this->belongsTo(vendors::class,'id', 'branch_id');
    }
}
