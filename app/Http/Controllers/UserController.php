<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\validator;
use Illuminate\Validation\Rules\File;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);
        $User=User::dynamicPaginate();
        return response()->json($User, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $CheckPoliciy = User::findOrFail($id);
        $this->authorize('update', $CheckPoliciy);
        $User = User::findOrFail($id);
        $validator=Validator::make($request->all(),[
            'name' => ['required','max:100','string','min:2'],
            'username'=>['required','min:6','max:25'],
            'phone' => ['required','regex:/^([0-9\s\-\+\(\)]*)$/','min:9'],
            'user_type_id'=>['required',Rule::exists('user_types','id')],
            'image'=>['required',Rule::when($request->hasFile('image'),[file::types(['jpeg','bmp','png','jpg'])->max(2048)]),Rule::when(is_string($request->image),'string')],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $image = $User->image;
        if ($request->hasFile('image')) {
            if (\File::exists($User->image)) {
                \File::delete($User->image);
            }
        $file = $request->file('image');
        $file_name = uniqid('', true) . '.' . $file->getClientOriginalExtension();
        $image = Storage::putFileAs('UserImage',$file , $File_name);
        $image = 'storage/' . $image;
}
        
        $users = $User->update([
            'name'=>$request->name,
            'username'=>$request->username,
            'phone'=>$request->phone,
            'user_type_id'=>$request->user_type_id,
            'image'=>$image,
        ]);
        
        return response()->json([
            'message'=>'user successfully registered',
            'user'=>$users
        ],201);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $CheckPoliciy = User::findOrFail($id);
        $this->authorize('delete',$CheckPoliciy);
        $User=User::findOrfail($id);
        $User->delete();
        return response()->json(['message'=>'User successfully deleted','data'=>$User,], 200);
    }
}