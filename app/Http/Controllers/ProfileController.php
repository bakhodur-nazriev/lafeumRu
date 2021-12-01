<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    const USERS_AVATARS_PATH = "/img/avatars/";

    public function index()
    {
        return view("/profile");
    }

    public function update($id)
    {
        /*request()->validate([
            "name" => "required",
            "email" => "required",
            "avatar" => "required",
            "password" => "required"
        ]);*/

        $user = User::find($id);
        $user->name = request("name");
        $user->email = request("name");

        if (request()->has("password")) {
            $user->password = Hash::make(request("password"));
        }

        if (request()->has("password")) {
            $user->password = Hash::make(request("password"));
        }

        if (request()->has("avatar")) {
            $user->avatar = $this->saveImage(time(), request()->avatar, self::USERS_AVATARS_PATH);
        }


        $user->save();

        return redirect("/profile");
    }
}
