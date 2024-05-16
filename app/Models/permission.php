<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permission extends Model
{
    use HasFactory;

    public function User()
    {
        return $this->belongsToMany(User::class,'permission_users');       
    }

    public function Type()
    {
        return $this->belongsToMany(UserType::class,'user_type_permissions');       
    }
}
