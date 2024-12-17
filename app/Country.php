<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
// use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
class Country extends Model 
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public $translatedAttributes = ['name'];
    public $table ='country';


    public $fillable=['status','code','shipping_rate','tax_prefix','name'];
    public function cities()
    {
        return $this->hasMany(City::class );
    }
}
