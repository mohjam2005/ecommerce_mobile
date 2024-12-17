<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
// use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
 class City extends Model 
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    public $table ='city';
    // public $translatedAttributes = ['name'];

    public $fillable=['status','country_id','currency','shipping_cost_speed','shipping_cost_slow','name'];

    public function country()
    {
        return $this->belongsTo(Country::class );
    }


}
