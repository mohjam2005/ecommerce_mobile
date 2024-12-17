<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileMangerStore extends Model
{
    protected $guarded = [];
    protected $appends = ['thump','thump370','thump770','image_url','icon'];


    public function getImageUrlAttribute(){
        if($this->name){
            return asset('uploads/store/'.$this->name);
        }else{
            return asset('front_assets/assets/images/default.jpg');
        }
    }
    public function getThumpAttribute()
    {
        if($this->is_big){
            return asset('uploads/store/'.$this->name);

        }
        return asset('uploads/store/thump_120/'.$this->name);
    }
    public function getIconAttribute()
    {

        return asset('uploads/store/thump_120/'.$this->name);
    }
    public function getThump370Attribute()
    {
        if($this->is_big){
            return asset('uploads/store/'.$this->name);

        }
        return asset('uploads/store/thump_370/'.$this->name);
    }
    public function getThump770Attribute()
    {
        if($this->is_big){
            return asset('uploads/store/'.$this->name);

        }
        return asset('uploads/store/thump_770/'.$this->name);
    }

//    public function is_big(){
//        if($this->is_big){
//            return asset('uploads/store/'.$this->name);
//
//        }
//    }




}
