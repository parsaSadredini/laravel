<?php

namespace App\Http\Controllers;

use App\User;
use Closure;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() 
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
        
    }

    public function login(Request $request){
        // sss and lll are hard coded just for test
        try{
            $http = new \GuzzleHttp\Client();
            $reponse = $http->post(config("services.passport.url"),
            ['form_params'=>[
                "grant_type"=>"password",
                "client_id"=>config("services.passport.client_id"),
                "client_secret"=>config("services.passport.client_secret"),
                "username"=>$request->username,
                "password" => $request->password,
                'scope'=>"sss lll"
            ]]);
            return $reponse->getBody();
        }catch(Exception $ex ){
            //this is also possible
            //abort(404 , "کاربری با این نام کاربری وجود ندارد")
            throw new BadRequestException("کاربری با این نام کاربری وجود ندارد");
        }
    }

    public function register(Request $request){
       
        $validation = Validator::make($request->toArray(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255','unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        
        if($validation->fails()){
            return $validation->errors()->messages();
        }

        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }

    public function logout()
    {
        
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });

        return response()->json('Logged out successfully', 200);
    }


}
