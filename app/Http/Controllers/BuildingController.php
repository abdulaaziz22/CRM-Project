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
        $this->authorize('viewAny', Building::class);
        $Bulids=Building::with(['College'])->filter()->dynamicPaginate();
        return response()->json($Bulids, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Building::class);
        $validator=Validator::make($request->all(),[
            'name'=>['required','max:100','min:1','string',Rule::unique('buildings')],
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
    public function update(Request $request, $id)
    {
        $CheckPoliciy = Building::findOrFail($id);
        $this->authorize('update', $CheckPoliciy);
        $Bulids = Building::findOrFail($id);
        $validator=Validator::make($request->all(),[
            'name'=>['required','max:100','min:1','string',Rule::unique('buildings')->ignore($Bulids->id)],
            'college_id'=>['required',Rule::exists('colleges','id')]
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $Bulids->update([
            'name'=>$request->name,
            'college_id'=>$request->college_id
        ]);
        return response()->json([
            'message'=>'Building successfully stored',
            'data'=>$Bulids,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $CheckPoliciy = Building::findOrFail($id);
        $this->authorize('delete',$CheckPoliciy);
        $Building=Building::findorfail($id);
        $Building->delete();
        return response()->json([
            'message'=>'Building successfully deleted',
            'data'=>$Building,
        ], 200);
    }
}
