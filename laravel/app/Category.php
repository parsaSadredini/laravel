<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "tbl_category";
    protected $fillable = [
        'title',"IDCategory"
    ];

    public function Products(){
        return $this->hasMany('App\\Product','CategoryId');
    }
   
    public static $validationRules = [
        'title' => 'required|max:50',
        'IDCategory' => 'nullable|exists:tbl_category,id'
    ];
}
