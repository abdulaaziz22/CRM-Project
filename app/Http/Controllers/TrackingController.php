<?php

namespace App\Http\Controllers;

use App\Models\Tracking;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\validator;
use App\Http\Controllers\FilePathController;

class TrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator::make($request->all(),[
            'subject'=>['required','min:2'],
            'details'=>['required','min:2'],
            'request_id'=>['required',Rule::exists('requests','id')],
            'to_user_id'=>['required',Rule::exists('users','id'),'not_in:' . auth()->user()->id],
            'Tracking_id'=>['sometimes',Rule::exists('trackings','id')],
            'file_path' => ['nullable'],
            'file_path.*' =>['file'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if($request->Tracking_id){
            $Tracking_old = Tracking::find($request->Tracking_id);
            $Tracking_old->update([
                'enddate' => now(),
            ]);
        }
        $Tracking=Tracking::create([
            'subject'=>$request->subject,
            'details'=>$request->details,
            'request_id'=>$request->request_id,
            'to_user_id'=>$request->to_user_id,
            'from_user_id'=>auth()->user()->id,
        ]);
        if(!empty($request->file_path)){
            FilePathController::store($request,$MyRequest=null,$Tracking->id);
        }
        return response()->json([
            'message'=>'Tracking successfully stored',
            'data'=>$Tracking,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tracking $tracking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tracking $tracking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tracking $tracking)
    {
        //
    }
}
