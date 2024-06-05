<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\validator;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', RoomType::class);
        $RoomTypes=RoomType::dynamicPaginate();
        return response()->json($RoomTypes, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', RoomType::class);
        $validator = validator::make($request->all(),[
            'name'=>['required','min:2','max:100',Rule::unique('room_types')],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $RoomType=RoomType::create([
            'name'=>$request->name
        ]);
        return response()->json([
            'message'=>'RoomType successfully stored',
            'data'=>$RoomType,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(RoomType $roomType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoomType $roomType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $CheckPoliciy = RoomType::findOrFail($id);
        $this->authorize('delete',$CheckPoliciy);
        $RoomType=RoomType::findorfail($id);
        $RoomType->delete();
        return response()->json([
            'message'=>'RoomType successfully deleted',
            'data'=>$RoomType,
        ], 200);
    }
}
