<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\validator;
use Illuminate\Validation\Rule;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() //  https://example.com?build_id=[value] | https://example.com?type_id=[value]
    {
        $this->authorize('viewAny', Room::class);
        $Rooms=Room::with(['RoomType:id,name','Building:id,name'])->filter()->dynamicPaginate();
        return response()->json($Rooms, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Room::class);
        $validator=Validator::make($request->all(),[
            'name'=>['required','max:100','min:2','string',Rule::unique('rooms')],
            'build_id'=>['required',Rule::exists('colleges','id')],
            'type_id'=>['required',Rule::exists('room_types','id')]
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $Room=Room::create([
            'name'=>$request->name,
            'build_id'=>$request->build_id,
            'type_id'=>$request->type_id
        ]);
        return response()->json([
            'message'=>'room successfully stored',
            'data'=>$Room,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $CheckPoliciy = Room::findOrFail($id);
        $this->authorize('update', $CheckPoliciy);
        $Room= Room::findOrFail($id);
        $validator=Validator::make($request->all(),[
            'name'=>['required','max:100','min:2','string',Rule::unique('rooms')->ignore($Room->id)],
            'build_id'=>['required',Rule::exists('colleges','id')],
            'type_id'=>['required',Rule::exists('room_types','id')]
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $Room->update([
            'name'=>$request->name,
            'build_id'=>$request->build_id,
            'type_id'=>$request->type_id
        ]);
        return response()->json([
            'message'=>'room successfully stored',
            'data'=>$Room,
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $CheckPoliciy = Room::findOrFail($id);
        $this->authorize('delete',$CheckPoliciy);
        $room=Room::findorfail($id);
        $room->delete();
        return response()->json([
            'message'=>'room successfully deleted',
            'data'=>$room,
        ], 200);
    }
}
