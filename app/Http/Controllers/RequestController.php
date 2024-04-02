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
        $MyRequest = MyRequest::filter()->with('Priority', 'RequestStatus', 'Category' , 'College')->dynamicPaginate();
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
            'file_path.*' =>['required','file'],
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
        $MyRequest = MyRequest::where('id', '=', $request)->first();
        // $college = College::where('id', '=', $MyRequest->college_id)->first();
        // $priority = Priority::where('id', '=', $MyRequest->priority_id)->first();
        // $status = RequestStatus::where('id', '=', $MyRequest->status_id)->first();

        // $data = [
        //     'Request' => $MyRequest,
        //     'College' => $college->name,
        //     'Priority'=> $priority->name,
        //     'Status' => $status->status
        // ];

        $data = MyRequest::with('college','RequestStatus' , 'Category')
            ->where('id', $request)
            ->with('Priority')
            ->first();

        $data = [
            'Request' => $MyRequest,
            'College' => $data->college->name,
            'Priority' => $data->priority,
            'Status' => $data->RequestStatus->status,
            'Category' => $data->Category->name
        ];

        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request , $id)
    {
        $MyRequest = MyRequest::where('id', '=', $id)->first();

        $validator = Validator::make($request->all(), [
            'status_id'=>[Rule::exists('request_statuses','id')],
            'priority_id'=>[Rule::exists('priorities','id')],
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