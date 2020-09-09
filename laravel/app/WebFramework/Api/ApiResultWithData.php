<?php

namespace App\WebFramework\Api;
use App\WebFramework\Api\ApiResult;
class ApiResultWithData extends ApiResult{

    public $Data;
    public function __construct($data = null,$isSucces_ = true , $apiResultStatusCode_ = 0 , $message_ = null)
    {
        parent::__construct($isSucces_,$apiResultStatusCode_,$message_); 
        
        if($data != null){
            $this->Data = $data;
        }else{
            unset($this->Data);
        }
    }
    public static function constructorWithCustomMessage($message_){
        return new ApiResultWithData(null,true,0,$message_);
     }
}
