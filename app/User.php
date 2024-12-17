<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
use Notifiable;
use HasRoles;
/**
* The attributes that are mass assignable.
*
* @var array
*/
protected $fillable = [
'name', 'user_name', 'password','roles_name','Status','branch_id','photo','email'
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
public function goverment()
    {
         return $this->belongsTo(vendors::class,'branch_id', 'id');
    }


public function orders(){
    return $this->hasMany('App\Models\Order');
}
public function vendor()
    {
        return $this->belongsTo(vendors::class,'vendor_id', 'id');
    }
    

    public function followedBranches()
    {
        return $this->belongsToMany(vendors::class, 'branch_user', 'user_id', 'branch_id');
    }


}