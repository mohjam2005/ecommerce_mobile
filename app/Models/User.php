<?php
namespace App\Models; // Update the namespace to avoid conflicts
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use App\vendors;

class User extends Authenticatable
{
use Notifiable;
use HasRoles;
use HasApiTokens;
/**
* The attributes that are mass assignable.
*
* @var array
*/
protected $fillable = [
'name', 'user_name', 'password','roles_name','Status','branch_id','phone','gender'
];
/**
* The attributes that should be hidden for arrays.
*
* @var array
*/
protected $hidden = [
'password', 'remember_token',
];
/**
* The attributes that should be cast to native types.
*
* @var array
*/
protected $casts = [
'email_verified_at' => 'datetime',
'roles_name' => 'array',

];
protected $guard_name = 'web';

public function goverment()
    {
         return $this->belongsTo(vendors::class,'id', 'branch_id');
    }

    public function products(){
 
         return $this->hasMany(Product::class,'vendor_id','id')->whereNotNull('vendor_id');

    }
    
    public function likedProducts()
    {
        return $this->belongsToMany(Product::class, 'product_user', 'user_id', 'product_id');
    }

    public function followedBranches()
    {
        return $this->belongsToMany(vendors::class, 'branch_user', 'user_id', 'branch_id');
    }


}