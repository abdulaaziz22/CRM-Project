<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\validator;
use Illuminate\Validation\Rule;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() //  https://example.com?college_id=[value]
    {
        $Bulids=Building::filter()->dynamicPaginate();
        return response()->json($Bulids, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'=>['required','max:100','min:2','string',Rule::unique('buildings')],
            'college_id'=>['required',Rule::exists('colleges','id')]
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $Bulids=Building::create([
            'name'=>$request->name,
            'college_id'=>$request->college_id
        ]);
        return response()->json([
            'message'=>'Building successfully stored',
            'data'=>$Bulids,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Building $building)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Building $building)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Building $building)
    {
        //
    }
}
