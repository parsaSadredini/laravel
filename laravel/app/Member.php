<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = "tbl_member";
    protected $fillable = [
        'Username','PasswordHash'
    ];
    
    public function setPasswordHashAttribute($value)
    {
        $this->attributes['PasswordHash'] = md5($value);
    }
    public static $validationRules = [
        'Username' => 'required|max:50',
        "PasswordHash"=>'required|max:50'
    ];
}
