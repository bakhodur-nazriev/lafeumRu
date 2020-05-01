<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Gate;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    const USERS_AVATARS_PATH = "/img/avatars/";

    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $users = User::with("role")->first();
        return view("auth.dashboard", compact("users"), ["user" => Auth::user()]);
    }

    public function edit(User $user)
    {
        if (Gate::denies("edit-users")) {
            return redirect(route("auth.dashboard"));
        }
        $roles = Role::all();
        return view("admin.users.edit")->with([
            "user" => $user,
            "roles" => $roles
        ]);
    }

    public function update(User $user, Request $request)
    {
        if (Gate::denies("delete-users")) {
            return redirect(route("admin.users.index"));
        }

        $newUserData = $request->only(["name", "email", "password"]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile("avatar")) {
            $newUserData['avatar'] = $this->saveImage(time(), $request->avatar, self::USERS_AVATARS_PATH);
        }
        $user->update($newUserData);

        $user->roles()->sync($request->roles);
        return $user;
    }

    public function destroy(User $user)
    {
        $user->roles()->detach();
        $user->delete();
        return redirect()->route("admin.users.index");
    }
}
