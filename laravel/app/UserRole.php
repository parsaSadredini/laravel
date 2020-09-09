<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = "tbl_user_role";
    protected $fillable = [
        'UserId','RoleId'
    ];
    public static $validationRules = [
        'RoleId' => 'required|numeric|exists:tbl_role,id'
    ];
    
    
}
