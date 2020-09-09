<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;
 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'FullName', 'email', 'password','Age','Gender','IsActive','LastDateLogin'
    ];

    public function Products(){
        return $this->hasMany('App\\Product','OperatorId');
    } 
    public function Roles(){
        return $this->belongsToMany('App\\Role','tbl_user_role','UserId','RoleId');
    }
    public static $validationRules = [
        'FullName' => 'required',
        'email' => 'required|email',
        'password' => 'required',
        'Gender' => 'required',
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
    ];
}
