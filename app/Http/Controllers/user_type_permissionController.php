<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user_type_permission;

class user_type_permissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator::make($request->all(),[
            'user_type_id' => ['required',Rule::exists('user_types', 'id')],
            'permission_id' => ['required',Rule::exists('permissions', 'id')],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $data = user_type_permission::firstOrCreate([
            'user_type_id' => $request->user_type_id,
            'permission_id' => $request->permission_id,
        ]);
        return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
