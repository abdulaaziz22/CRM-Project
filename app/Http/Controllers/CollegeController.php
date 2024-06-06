<?php

namespace App\Http\Controllers;

use App\Models\College;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\validator;

class CollegeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', College::class);
        $Colleges=College::dynamicPaginate();
        return response()->json($Colleges, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', College::class);
        $validator = validator::make($request->all(),[
            'name'=>['required','min:2','max:100',Rule::unique('colleges')],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $college=College::create([
            'name'=>$request->name
        ]);
        return response()->json([
            'message'=>'college successfully stored',
            'data'=>$college,
        ], 200);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(College $college)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $CheckPoliciy = College::findOrFail($id);
        $this->authorize('update', $CheckPoliciy);
        $college = College::findOrFail($id);
        $validator = validator::make($request->all(),[
            'name'=>['required','min:2','max:100',Rule::unique('colleges')->ignore($college->id)],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $college->update([
            'name'=>$request->name
        ]);
        return response()->json([
            'message'=>'college successfully stored',
            'data'=>$college,
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $CheckPoliciy = College::findOrFail($id);
        $this->authorize('delete',$CheckPoliciy);
        $College=College::findorfail($id);
        $College->delete();
        return response()->json([
            'message'=>'College successfully deleted',
            'data'=>$College,
        ], 200);
    }
}
