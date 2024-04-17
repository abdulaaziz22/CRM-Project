<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mehradsadeghi\FilterQueryString\FilterQueryString;
use App\Models\RequestStatus;
use App\Models\Priority;
use App\Models\Category;
use App\Models\Tracking;
use App\Models\College;



class Request extends Model
{
    use HasFactory ,FilterQueryString;

    protected $fillable = [
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


    public function FilePaths()
    {
        return $this->hasMany(FilePath::class);
    }

    public function RequestStatus()
    {
        return $this->belongsTo(RequestStatus::class,'status_id','id');
    }

    public function User()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function Room()
    {
        return $this->belongsTo(Room::class,'room_id','id');
    }

    public function Priority()
    {
        return $this->belongsTo(Priority::class,'priority_id','id');
    }

    public function Category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function College()
    {
        return $this->belongsTo(College::class,'college_id','id');
    }

    public function Tracking()
    {
        return $this->hasMany(Tracking::class);
    }
}
