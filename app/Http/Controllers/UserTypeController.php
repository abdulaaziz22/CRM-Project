<?php

namespace App\Http\Controllers;

use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\validator;
use Illuminate\Validation\Rule;

class UserTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Types=UserType::dynamicPaginate();
        return response()->json($Types, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator::make($request->all(),[
            'type'=>['required','min:2',Rule::unique('user_types')],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $data = UserType::Create([
            'type' => $request->type,
        ]);
        return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(UserType $userType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserType $userType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    { 
        $UserType=UserType::findOrfail($id);
        $UserType->delete();
        return response()->json(['message'=>'UserType successfully deleted','data'=>$UserType,], 200);
    }
}
