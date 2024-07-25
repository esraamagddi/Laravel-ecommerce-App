<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        User::create([
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

    public function login(Request $request){
       $validator= Validator::make($request->all(),[
            'email'=>'required|string|email',
            'password'=>'required|string|min:8'
        ]);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()],400);
        }
        $user=User::where('email','=',$request->email)->first();
        if($user !==null){
            $oldPassword=$user->password;
            $isVerified=Hash::check($request->password, $oldPassword);
            if($isVerified){
                $user->update([
                    'access_token'=>Str::random(64)
                ]);
                return response()->json([
                    'message'=>'Logged in successfully',
                    'access_token'=>$user->access_token
                ],200);

            }else{
                return response()->json(['message'=>'cerdintials not correct'],401);
            }


        }else{
            return response()->json(['message'=>'User not found'],404);
        }

    }

    public function logout(Request $request){
        $access_token=$request->header('access_token');
        if($access_token !==null){
            $user=User::where("access_token","=",$access_token)->first();
            if($user!==null){
                $user->update([
                    'access_token'=>null,
                ]);
                return response()->json(['message'=>'logged out successfully'],200);

            }else{
                return response()->json(['message'=>'Access token not correct'],401);
            }
        }else{
            return response()->json(['message'=>'Access token not provided'],401);
        }
    }
}
