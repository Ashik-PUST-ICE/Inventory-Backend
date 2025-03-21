<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthenticationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(AuthenticationRequest $request){
        $credientials=[
          'email'=>$request->email,
          'password'=>$request->password,
        ];

        if (Auth::attempt($credientials, true)) {
            $user =Auth::user();

            $response=[
                'status_code'=>200,
                'status'=>'success',
                'data'=>[
                    'token'=>$user->createToken('ashik')->plainTextToken,
                    'name'=>$user->name
                ],
                'message'=>'Login Successfull !'
            ];

            return response()->json($response,200);
        }

        else {
            $response=[
                'status_code'=>401,
                'status'=>'error',
                'data'=>'null',
                'message'=>'Unauthorized !'
            ];

            return response()->json($response,401);
        }


    }
}
