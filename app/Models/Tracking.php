<?php

namespace App\Models;

use App\Models\User;
use App\Models\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tracking extends Model
{
    use HasFactory;

    protected $fillable = ['enddate' , 'details' , 'subject','request_id','from_user_id','to_user_id'];

    public function Request()
    {
        return $this->belongsTo(Request::class,'request_id','id');
    }
    public function from_user()
    {
        return $this->belongsTo(User::class,'from_user_id','id');
    }
    public function to_user()
    {
        return $this->belongsTo(User::class,'to_user_id','id');
    }
}
