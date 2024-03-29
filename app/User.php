<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable /*implements MustVerifyEmail*/
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        "name",
        "email",
        "password",
        "avatar",
        "country",
        "age",
        "gender",
        "hobby"
    ];

//    public function favorites()
//    {
//        $user = Auth::user();
//        $user->favorite(Quote::class);
//    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        "password", "remember_token",
    ];

    /*public function quotes()
     {
         return $this->hasMany("App\Quote");
     }*/

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    protected $casts = [
        "email_verified_at" => "datetime",
    ];

    public function role()
    {
        return $this->belongsTo("App\Role");
    }

    public function hasAnyRoles($roles)
    {
        return in_array($this->role->name, $roles);
    }

    public function hasRole($role)
    {
        return $this->role->name === $role;
    }
}
