<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Request as MyRequest;


class Priority extends Model
{
    use HasFactory;

    protected $fillable = ['name']; 
    
    
    public function Request()
    {
        return $this->hasMany(MyRequest::class);
    }

    

}
