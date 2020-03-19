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
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $users = User::all();
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

    public function update(Request $request, User $user, $id)
    {
        if (Gate::denies("delete-users")) {
            return redirect(route("admin.users.index"));
        }
        $user->name = $request->name;
        $user->email = $request->email;

        $user = User::find($id);
        $newPhotoData = $request->only(["name", "email", "password"]);
        if ($request->hasFile("avatar")) {
            $newPhotoData["avatar"] = $this->saveImage(time(), $request->avatar);
        }
        $user->update($newPhotoData);

        $user->roles()->sync($request->roles);
        return $user;
    }

    public function delete(User $user)
    {
        $user->roles()->detach();
        $user->delete();
        return redirect()->route("admin.users.index");
    }
}
