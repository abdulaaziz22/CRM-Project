<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilePath extends Model
{
    use HasFactory;

    protected $fillable = ['path','request_id','tracking_id'];

    public function Request()
    {
        return $this->belongsTo(Request::class,'request_id','id');
    }
    public function Track()
    {
        return $this->belongsTo(Tracking::class,'tracking_id','id');
    }
}
