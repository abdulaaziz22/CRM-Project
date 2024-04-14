<?php

namespace App\Http\Controllers;

use App\Models\FilePath;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Request as MyRequest;
use Illuminate\Support\Facades\validator;
use App\Http\Controllers\FilePathController;
use App\Models\College;
use App\Models\Priority;
use App\Models\RequestStatus;


class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $MyRequest = MyRequest::filter()->with(['Priority', 'RequestStatus', 'Category' , 'College'])->dynamicPaginate();
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
            'file_path' => ['nullable'],
            'file_path.*' =>['file'],
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
        if(!empty($request->file_path)){
            FilePathController::store($request,$MyRequest->id,$tracking_id=null);
        }
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
        $MyRequest = MyRequest::with(['college', 'RequestStatus', 'Category', 'Priority', 'filePaths'])
                 ->findOrFail($request);
        $data = [
            'id'=>$MyRequest->id,
            'title'=>$MyRequest->title,
            'description'=>$MyRequest->description,
            'close_at'=>$MyRequest->close_at,
            'College' => $MyRequest->college,
            'Priority' => $MyRequest->priority,
            'Status' => $MyRequest->RequestStatus,
            'Category' => $MyRequest->Category,
            'filePaths'=>$MyRequest->filePaths,
        ];
        return response()->json(['data'=>$data], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request , $id)
    {
        $MyRequest = MyRequest::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'status_id'=>['sometimes',Rule::exists('request_statuses','id')],
            'priority_id'=>['sometimes',Rule::exists('priorities','id')],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $MyRequest->update([
            'status_id' => $request->status_id,
            'priority_id' => $request->priority_id,
        ]);
        return response()->json([
            'message'=>'Request successfully updated',
            'data'=>$MyRequest,
            ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
    }

}
