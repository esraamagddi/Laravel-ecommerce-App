<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class ApiAuthController extends Controller
{
    //
    public function register(Request $request){
       $validator= Validator::make($request->all(),[
            'name'=>'required|string|max:255',
            'email'=>'required|string|email',
            'password'=>'required|string|min:8|confirmed'
        ]);

        if ($validator->fails()){
            return response()->json(['errors'=>$validator->errors()],400);
        }

        $password= bcrypt($request->password);
        $access_token=Str::random(255);
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$password,
            'access_token'=>$access_token,
        ]);

        return response()->json([
            'message'=>"registered successfully",
            'access_token'=>$access_token
    ],201);

    }
}
