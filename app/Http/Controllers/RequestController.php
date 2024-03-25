<?php

namespace App\Http\Controllers;

use App\Models\FilePath;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Request as MyRequest;
use Illuminate\Support\Facades\validator;
use App\Http\Controllers\FilePathController;


class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $MyRequest = MyRequest::filter()->dynamicPaginate();
        return response()->json($MyRequest, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator::make($request->all(),[
            'title'=>['required','min:2'],
            'description'=>['required','min:2'],
            'room_id'=>['required',Rule::exists('rooms','id')],
            'category_id'=>['required',Rule::exists('categories','id')],
            'college_id'=>['required',Rule::exists('colleges','id')],
            'files' => ['required','file'],
            'files.*' =>['required','file','max:2048'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $MyRequest=MyRequest::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'close_at'=>null,
            'room_id'=>$request->room_id,
            'status_id'=>'1',
            'priority_id'=>null,
            'category_id'=>$request->category_id,
            'college_id'=>$request->college_id,
            'user_id'=>'1',
        ]);
        FilePathController::store($request->files,$MyRequest->id,$tracking_id=null);
        return response()->json([
            'message'=>'Request successfully stored',
            'data'=>$MyRequest,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($request)
    {
        $MyRequest = MyRequest::where('id', '=', $request)->get();
        return response()->json($MyRequest, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
    }
}
