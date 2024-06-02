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
        $Rooms=Room::with(['RoomType:id,name','Building:id,name'])->filter()->dynamicPaginate();
        return response()->json($Rooms, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
    public function update(Request $request, Room $room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        //
    }
}
