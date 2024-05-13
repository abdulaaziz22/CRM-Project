<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permission extends Model
{
    use HasFactory;

    public function User()
    {
        return $this->belongsToMany(User::class,'permission_users','permission_id','user_id');       
    }

    public function Type()
    {
        return $this->belongsToMany(UserType::class,'user_type_permissions','permission_id','user_type_id');       
    }
}