<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ADMIN_ROLE_NAME = "Администратор";
    const AUTHOR_ROLE_NAME = "Автор";
    const MEMBER_ROLE_NAME = "Подписчик";

    public $timestamps = false;

    public function users()
    {
        return $this->hasMany("App\User");
    }
}
