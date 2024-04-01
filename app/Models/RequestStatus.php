<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Request as MyRequest;

class RequestStatus extends Model
{
    use HasFactory;

    protected $fillable = ['status'];


    public function Request()
    {
        return $this->hasMany(MyRequest::class);
    }

}
