<?php

namespace App\Policies;

use App\Role;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostsPolicy extends GlobalPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any posts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the post.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole(Role::AUTHOR_ROLE_NAME);
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->hasRole(Role::ADMIN_ROLE_NAME);
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->hasRole(Role::AUTHOR_ROLE_NAME);
    }
}
