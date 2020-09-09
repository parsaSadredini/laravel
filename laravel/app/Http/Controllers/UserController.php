<?php

namespace App\Http\Controllers;

use App\Common\Exceptions\ListEmptyException;
use App\Common\Exceptions\NotFoundException;
use App\User;
use App\WebFramework\Api\ApiResult;
use App\WebFramework\Api\ApiResultWithData;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function get()
    {
        $users = User::all();
        if(count($users) <= 0 )
            throw new ListEmptyException();

        return response()->json(new ApiResultWithData($users));
    }

    public function getById($id)
    {
        $user = User::find($id);
        if($user == null )
            throw new NotFoundException();
            
        return response()->json(new ApiResultWithData($user));
    }

    public function create(Request $request)
    {
        $this->performValidation($request);
        $hash = Hash::make($request->password);
        $user  = new User($request->toArray());
        $user->password = $hash;
        $user->save();
        $user->Roles()->sync($request->RoleIds);
        return Response()->json(new ApiResultWithData($user ));
    }

    public function update(User $user, Request $request)
    {
        $this->performValidation($request);


        $user->update($request->toArray());
        $user->Roles()->sync($request->RoleIds);
        return Response()->json(new ApiResultWithData($user));
    }

    public function delete(User $user)
    {
        $user->delete();
        return Response()->json(new ApiResult());
    }

    public function login(Request $request){
        // try{
            
            $user = User::where("email",$request->username)->first();      
            if(!Hash::check($request->password, $user->password))
                return;
            $http = new \GuzzleHttp\Client();
            $reponse = $http->post(config("services.passport.url"),
            ['form_params'=>[
                "grant_type"=>"password",
                "client_id"=>config("services.passport.client_id"),
                "client_secret"=>config("services.passport.client_secret"),
                "username"=>$request->username,
                "password" => $request->password,
                'scope'=>implode(" ",$user->Roles->toArray()) 
            ]]);
            
            return $reponse; 
        // }catch(Exception $ex ){

        // }
    }

    private function performValidation($request)
    {
        $validator = Validator::make($request->toArray(), User::$validationRules);
        if ($validator->fails())
            throw new ValidationException($validator);
    }
}
