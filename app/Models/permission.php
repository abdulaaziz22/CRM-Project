<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permission extends Model
{
    use HasFactory;

    public function User()
    {
        return $this->belongsToMany(Book::class,'permission_users','permission_id','user_id');       
    }
}
