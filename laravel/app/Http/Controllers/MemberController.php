<?php

namespace App\Http\Controllers;

use App\Category;
use App\Member;
use App\WebFramework\Api\ApiResultWithData;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class MemberController extends Controller
{
    public function SigUp(Request $request){
        $hashPassword = md5($request->password);
        $existingUser = Member::where("UserName",$request->username)->where("PasswordHash",$hashPassword)->first();
        if($existingUser != null)
            throw new BadRequestException("کاربر با این نام کاربری وجود دارد");

        $member = new Member([ "PasswordHash" => $request->password, "Username" => $request->username]);
        $member->save();
        return Response()->json(new ApiResultWithData($member));
    }

    public function SigIn(Request $request){
        $hashPassword = md5($request->password);
        $existingUser = Member::where("UserName",$request->username)->where("PasswordHash",$hashPassword)->first();

        if($existingUser == null)
            throw new BadRequestException("کاربری با این نام کاربری وجود ندارد");

        return Response()->json(new ApiResultWithData($existingUser));
    }

    public function GetGetegories(){
        return Response()->json(new ApiResultWithData(Category::all())); 
    }

    public function GetProductByCategoryId(Category $category){
        return  Response()->json(new ApiResultWithData($category->Products));
    }
}
