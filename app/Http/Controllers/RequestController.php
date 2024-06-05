<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use App\Models\College;
use App\Models\Category;
use App\Models\FilePath;
use App\Models\Priority;
use App\Models\Tracking;
use Illuminate\Http\Request;
use App\Models\RequestStatus;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\Request as MyRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\validator;
use App\Http\Controllers\FilePathController;



class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_tracking_request=Tracking::where('to_user_id','=',Auth::user()->id)->pluck('request_id');
        $requests = MyRequest::with(['College', 'RequestStatus', 'Category', 'Priority','User', 'Room'])
        ->where('user_id','=',Auth::user()->id)->orWhereIn('id',$user_tracking_request)
        ->get()
        ->map(function ($request) {
        return [
            'id' => $request->id,
            'title' => $request->title,
            'created_at' => $request->created_at,
            'updated_at' => $request->updated_at,
            'college' => $request->college->name ?? null,
            'priority' => $request->priority->name ?? null,
            'status' => $request->requestStatus->status,
            'category' => $request->category->name,
            'room' => $request->room->name ?? null,
            'user' => $request->user->name,
        ];
    });

return response()->json(['data' => $requests], 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', MyRequest::class);
        $validator = validator::make($request->all(),[
            'title'=>['required','min:2'],
            'description'=>['required','min:2'],
            'room_id'=>['nullable',Rule::exists('rooms','id')],
            'category_id'=>['required',Rule::exists('categories','id')],
            'college_id'=>['nullable',Rule::exists('colleges','id')],
            'priority_id' =>['required',Rule::exists('priorities','id')],
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
            'status_id'=>1,
            'priority_id'=>$request->priority_id,
            'category_id'=>$request->category_id,
            'college_id'=>$request->college_id,
            'user_id'=>auth()->user()->id,
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
        $CheckPoliciy = MyRequest::findOrFail($request);
        $this->authorize('view', $CheckPoliciy);
        $MyRequest = MyRequest::with(['College', 'RequestStatus', 'Category', 'Priority', 'FilePaths','User','Room'])
                 ->findOrFail($request);
        $data = [
            'id' => $MyRequest->id,
            'title' => $MyRequest->title,
            'description' => $MyRequest->description,
            'close_at' => $MyRequest->close_at,
            'created_at' => $MyRequest->created_at,
            'updated_at' => $MyRequest->updated_at,
            'college' => $MyRequest->college->name ?? null,
            'priority' => $MyRequest->priority->name ?? null,
            'status' => $MyRequest->RequestStatus->status,
            'category' => $MyRequest->Category->name,
            'room' => $MyRequest->Room->name ?? null,
            'room_type' => $MyRequest->room->RoomType->name,
            'building' => $MyRequest->room->building->name,
            'user' => $MyRequest->User->name,
            'user_phone' => $MyRequest->User->phone,
            'user_image' => $MyRequest->User->image,
            'user_type' => $MyRequest->User->Type->type,
            'filePaths' => $MyRequest->filePaths,
        ];
        return response()->json(['data'=>$data], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request , $id)
    {
        $CheckPoliciy = MyRequest::findOrFail($id);
        $this->authorize('update', $CheckPoliciy);
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
