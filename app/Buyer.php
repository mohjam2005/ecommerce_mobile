<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
// use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
class Buyer extends Model 
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public $translatedAttributes = ['name'];

    public $fillable=['country_id','jawwal','jawwal_extra','fav','city_id','country_id'];
    public function cities()
    {
        return $this->hasMany(City::class );
    }
}
