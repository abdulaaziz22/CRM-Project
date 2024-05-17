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
        $this->authorize('viewAny', UserType::class);
        $Types = UserType::with('permission')->get();
        $data = $Types->map(function ($userType) {
            return [
                'id' => $userType->id,
                'type' => $userType->type,
                'created_at' => $userType->created_at,
                'updated_at' => $userType->updated_at,
                'permissions' => $userType->permission->map(function ($permission) {
                return $permission->display_name;
                }),
            ];
        });
        
        return response()->json($data, 200);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', UserType::class);

        $validator = Validator::make($request->all(), [
            'type' => ['required', 'min:2', Rule::unique('user_types')],
            'permissions' => ['required', 'array']
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $data = UserType::create([
            'type' => $request->type,
        ]);
        
        $data->permission()->attach($request->permissions);
        
        return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $Type=UserType::with(['permission'])->findOrfail($id);
        $data = [
            'id' => $Type->id,
            'Type' => $Type->type,
            'permissions' => $Type->permission->pluck('id'),
        ];
        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $CheckPoliciy = UserType::findOrFail($id);
        $this->authorize('update', $CheckPoliciy);
        $UserType = UserType::findOrFail($id);
        $validator=Validator::make($request->all(),[
            'type'=>['required','min:2',Rule::unique('user_types')->ignore($UserType->id)],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $UserType->update([
            'type'=>$request->type,
        ]);

        $UserType->permission()->sync($request->permissions);
        return response()->json([
            'message'=>'UserType successfully updated',
            'data'=>$UserType,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    { 
        $CheckPoliciy = UserType::findOrFail($id);
        $this->authorize('delete',$CheckPoliciy);
        $UserType=UserType::findOrfail($id);
        $UserType->delete();
        return response()->json(['message'=>'UserType successfully deleted','data'=>$UserType,], 200);
    }
}
