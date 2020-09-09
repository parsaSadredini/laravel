<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = "tbl_role";
    protected $fillable = [
        'Name','Description'
    ];
    public function Users(){
        return $this->belongsToMany('App\\User','tbl_user_role','RoleId','UserId');
    }
    public static $validationRules = [
        'Name' => 'required|max:50',
        'Description' => 'required|max:250'
    ];
}
