<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\models\Settings;
use App\models\Product;
class vendors extends Model
{
    protected  $table = 'branches';

    protected $fillable = [
        'branch_name',
        'created_by'
     ];
     public function setting()
     {
         return $this->hasOne(Settings::class,'branch_id', 'id');
     }

     public function products()
     {
         return $this->hasMany(Product::class,'vendor_id','id');
     }

     public function followers()
     {
         return $this->belongsToMany(User::class, 'branch_user', 'branch_id', 'user_id');
     }
     public function getIsFollowAttribute()
     {
         // Check if the authenticated user has liked this product
         return auth()->user() ? $this->followers()->where('user_id', auth()->id())->exists() : false;
     }

}
