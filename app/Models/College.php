<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Request as MyRequest;

class College extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = ['name'];

    public function buildings ()
    {
        return $this->hasMany(Building::class);
    }

    public function Request()
    {
        return $this->hasMany(MyRequest::class);
    }
}
