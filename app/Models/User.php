<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Request as MyRequest;
use App\Models\UserType;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'password',
        'username',
        'phone',
        'image',
        'user_type_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'username'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function Request()
    {
        return $this->hasMany(MyRequest::class);
    }

    public function Type()
    {
        return $this->belongsTo(UserType::class,'user_type_id','id');
    }

    public function permission()
    {
        return $this->belongsToMany(permission::class,'permission_users');
    }

    public static function hasPermission($permission)
    {
        // return UserType::find(auth()->user()->Type->id)->permission;
        return auth()->user()->Type->permission->contains('name', $permission);
    }
}
