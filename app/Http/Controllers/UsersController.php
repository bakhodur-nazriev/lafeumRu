<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Gate;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    const USERS_AVATARS_PATH = "/img/avatars/";

    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware("auth");
        $this->authorizeResource(User::class);
    }

    public function index()
    {
        return User::with("role")->get();
    }

    public function show(User $user)
    {
        return $user;
    }

    public function update(User $user, Request $request)
    {
        $updatedUserData = $request->only(["name", "email", "password"]);

        if ($request->hasFile("avatar")) {
            $updatedUserData['avatar'] = $this->saveImage(time(), $request->avatar, self::USERS_AVATARS_PATH);
        }

        $user->update($updatedUserData);

        $authIsAdmin = auth()->user()->hasRole(Role::ADMIN_ROLE_NAME);

        if($authIsAdmin && $request->role_id){
            $user->role_id = $request->role_id;
            $user->save();
        }

        return $user;
    }

    public function destroy(User $user)
    {
        $user->delete();
    }
}
