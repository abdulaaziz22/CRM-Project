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
        $Colleges=College::dynamicPaginate();
        return response()->json($Colleges, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
    public function update(Request $request, College $college)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(College $college)
    {
        //
    }
}
