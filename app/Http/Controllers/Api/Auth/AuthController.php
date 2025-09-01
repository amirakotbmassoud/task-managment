<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Interface\Auth\AuthInterface;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ResponseTrait;
    protected $auth;
public function __construct(AuthInterface $auth)
{
$this->auth=$auth;
}
// public function register(UserRequest $request){
// try{
//     $user=$this->auth->register($request->validated());
//     return self::success('success','User Registerd successfully',$user,201);

// }catch(\Exception $e){
//     return self::error('error',$e->getMessage(),500);
// }

// }
public function login (LoginRequest $request) {
   try
   {
    $credentials=$request->only('email','password');
    $result=$this->auth->login($credentials);
    if(!$result){
        return self::error('error','Unauthorized',401);
    }
    [$user,$token]=$result;
    return self::success('success','User Logged in sucessfully',['user'=>$user,'token'=>$token],200);
   }
   catch(\Exception $e){
    return self::error('error',$e->getMessage(),500);

   }
}

// public function logout()
// {
//     try{
// $result=$this->auth->logout();
// if($result){
//     return self::success('success','User Loged out succesfully',[],200);
// }
//     }
//     catch(\Exception $e){
//         return self::error('error',$e->getMessage(),500);
//     }
// }
}
