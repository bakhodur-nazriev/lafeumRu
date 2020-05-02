<?php

namespace App\Policies;

use App\Role;

abstract class GlobalPolicy
{
    public function before($user, $ability)
    {
        if($user->hasRole(Role::ADMIN_ROLE_NAME)){
            return true;
        }
    }
}
