<?php

namespace App\Repository\Auth;

use App\Interface\Auth\AuthInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthInterface
{
    // public function register(array $data)
    // {
    //     //logic for register
    //     $user = User::create(
    //         ['name' => $data['name']
    //         , 'email' => $data['email']
    //         , 'password' => Hash::make($data['password']),
    //          'role' => $data['role'] ?? 'user']);
    //          $token=Auth::login($user);
    //          return [$user,$token];
    //         }
            public function login (array $credinalts){
                if(!$token=Auth::attempt($credinalts)){
                    return null;
                }
                $user=Auth::user();
                return [$user,$token];
            }

            // public function logout()
            // {
            //     Auth::logout();
            // return true;
            // }

    //
}
