<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;

    protected $fillable = ['type'];
    protected $hidden = ['created_at','updated_at'] ;
    
    public function permission()
    {
        return $this->belongsToMany(permission::class,'user_type_permissions');       

    }
}
