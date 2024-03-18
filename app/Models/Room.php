<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','build_id','type_id'];

    public function RoomType()
    {
        return $this->belongsTo(RoomType::class,'type_id','id');
    }

    public function Building()
    {
        return $this->belongsTo(Building::class,'build_id','id');
    }
}
