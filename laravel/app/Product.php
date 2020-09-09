<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Product extends Model
{
    protected $table = "tbl_product";
    protected $fillable = [
        'Name','ImageUrl','Price','CategoryId'
    ];

    public function Category(){
        // return $this->belongsTo('App\\Category','CategoryId');
        return $this->hasOne('App\\Category','id','CategoryId');
    }
    public function Operator(){
        return $this->hasOne('App\\User','id','OperatorId');
    }
    
    public static $validationRules = [
        'Name' => 'required|max:100',
        "Price"=>"required|numeric",
        'CategoryId'=>"required|numeric|exists:tbl_category,id",
    ];
}
