<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_type_permission extends Model
{
    use HasFactory;
    protected $fillable = ['user_type_id' , 'permission_id'];
}
