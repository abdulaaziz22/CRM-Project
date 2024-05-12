<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tracking;
use App\Events\PrivateTest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\validator;
use App\Notifications\Trackingnotification;
use App\Http\Controllers\FilePathController;
use Illuminate\Support\Facades\Notification;


class TrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() //https://example.com?sort=created_at,[desc|asc] asc by default
    {
        $Tracking=Tracking::with(['Request','from_user','to_user','FilePaths'])->filter()->dynamicPaginate();
        return response()->json(['data' => $Tracking], 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Tracking::class);
        $validator = validator::make($request->all(),[
            'subject'=>['required','min:2'],
            'details'=>['required','min:2'],
            'request_id'=>['required',Rule::exists('requests','id')],
            'to_user_id'=>['required',Rule::exists('users','id'),'not_in:' . auth()->user()->id],
            'Tracking_id'=>['nullable','sometimes',Rule::exists('trackings','id')],
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
        $user=User::find($Tracking->to_user_id);
        Notification::send($user, new Trackingnotification($Tracking->id,$Tracking->subject,auth()->user()->name,auth()->user()->image));
        return response()->json([
            'message'=>'Tracking successfully stored',
            'data'=>$Tracking,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($tracking)
    {
        $CheckPoliciy = Tracking::findOrFail($tracking);
        $this->authorize('view', $CheckPoliciy);
        $Tracking=Tracking::with(['from_user','to_user','FilePaths'])->findOrfail($tracking);
        $data = [
            'id' => $Tracking->id,
            'enddate' => $Tracking->enddate,
            'details' => $Tracking->details,
            'subject' => $Tracking->subject,
            'created_at' => $Tracking->created_at,
            'updated_at' => $Tracking->updated_at,
            'request_id' => $Tracking->request_id,
            'from_user' => $Tracking->from_user->name,
            'to_user' => $Tracking->to_user->name,
            'filePaths' => $Tracking->filePaths,
        ];
        return response()->json($data, 200);
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
