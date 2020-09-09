<?php

namespace App\WebFramework\Api;
use App\Common\StandardApiResultStatusCode;

class ApiResult {
    public $isSucces;
    public $apiResultStatusCode;
    public $message;
    public function __construct($isSucces_ = true , $apiResultStatusCode_ = 0 , $message_ = null)
    {
        $this->isSucces = $isSucces_;
        $this->apiResultStatusCode = $apiResultStatusCode_;
        if($message_ == null){
            $this->message = StandardApiResultStatusCode::defaultMessages[$apiResultStatusCode_];
        }else{
            $this->message = $message_;
        }
    }

    public static function constructorWithCustomMessage($message_){
       return new ApiResult(true,0,$message_);
    }
} 

