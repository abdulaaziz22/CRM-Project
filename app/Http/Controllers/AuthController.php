<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\validator;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name' => ['required','max:100','string','min:2',],
            'email' => 'required|email|unique:users',
            'password'=>['required','min:6','confirmed'],
            'username'=>['required','min:6','max:25','unique:users,username'],
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $image = null;
        if ($request->image)
        {
            $File_name=uniqid('',true).'.'.$request->image->getclientoriginalextension();
            $image=Storage::putFileAs('UserImage',$request->image,$File_name);
        }
    
        $user = User::create([
            'name'=>$request->name,
            'password'=>$request->password,
            'username'=>$request->username,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'user_type_id'=>$request->user_type_id,
            'image'=>$image,
        ]);

        return response()->json([
            'message'=>'user successfully registered',
            'user'=>$user
        ],201);
    }

    public function login(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'email'=> 'required|email',
            'password'=>'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('authToken')->accessToken;
                return response($token->token, 200);
            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ["message" =>'User does not exist'];
            return response($response, 422);
        }        
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        
        return response()->json(['message' => 'Successfully logged out']);
    }
}
