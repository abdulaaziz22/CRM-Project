<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'title',
        'description',
        'close_at',
        'room_id',
        'status_id',
        'user_id',
        'priority_id',
        'category_id',
        'college_id',
        'file_path_id'
    ];

}
