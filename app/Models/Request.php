<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mehradsadeghi\FilterQueryString\FilterQueryString;


class Request extends Model
{
    use HasFactory ,FilterQueryString;

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

    protected $filters = [
        'college_id', 
        'status_id',
        'priority_id',
        'category_id',
        'room_id',
        ];


    public function filePaths()
    {
        return $this->hasMany(FilePath::class);
    }

}
