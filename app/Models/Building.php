<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = ['name','college_id'];

    public function College ()
    {
        return $this->belongsTo(College::class,'college_id','id');
    }

    public function Rooms()
    {
        return $this->hasMany(Room::class);
    }

}
