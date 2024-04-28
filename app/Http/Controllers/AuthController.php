<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Events\test_websocketevent;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\validator;

class AuthController extends Controller
{
    public function index()
    {
        $User=User::get();
        return response()->json(['data' => $User], 200);

    }

    public function testwebsocket()  {
        event(new test_websocketevent());
    }

    public function register(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name' => ['required','max:100','string','min:2'],
            'password'=>['required','min:6','confirmed'],
            'username'=>['required','min:6','max:25',Rule::unique('users')],
            'phone' => ['required','regex:/^([0-9\s\-\+\(\)]*)$/','min:9'],
            'user_type_id'=>['required',Rule::exists('user_types','id')],
            'image'=>[File::image()]
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $image = null;
        if ($request->image)
        {
            $File_name=uniqid('',true).'.'.$request->image->getclientoriginalextension();
            $image = Storage::putFileAs('UserImage',$request->image,$File_name);
            $image ='storage/'.$image;
        }

        $user = User::create([
            'name'=>$request->name,
            'password'=>$request->password,
            'username'=>$request->username,
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
        $validator = Validator::make($request->all(), [
        'username' => 'required',
        'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::with('Type')->where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'access_token' => $token,
                'user' => $user,
            ]);
        }
        else {
            return response()->json([
                'message' => $user ? 'Password mismatch' : 'User does not exist'
            ], 422);
        }
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message' => 'Successfully logged out']);
    }


}
