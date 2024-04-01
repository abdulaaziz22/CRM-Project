<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Request as MyRequest;

class Tracking extends Model
{
    use HasFactory;

    protected $fillable = ['startdate' , 'enddate' , 'details' , 'subject'];

    public function Request()
    {
        return $this->belongsTo(MyRequest::class,'category_id','id');
    }
}
