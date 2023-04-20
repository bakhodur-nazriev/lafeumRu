<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    const USERS_AVATARS_PATH = "/img/avatars/";

    public function index()
    {
        return view("/profile");
    }

    public function update(User $user, Request $request)
    {
        $updatedUserData = $request->all();

        if ($request->has('name') && $user->name !== $request->input('name')) {
            $user->name = $request->input('name');
        }

        if ($request->has('email') && $user->email !== $request->input('email')) {
            $user->email = $request->input('email');
        }

        if ($request->has('age') && $user->email !== $request->input('age')) {
            $user->email = $request->input('age');
        }

        if ($request->has('gender') && $user->email !== $request->input('gender')) {
            $user->email = $request->input('gender');
        }

        if ($request->has('password')) {
            $user->password = Hash::make(request('password'));
        }

        if ($request->has('avatar')) {
            $user->avatar = $this->saveImage(time(), request()->avatar, self::USERS_AVATARS_PATH);
        }

        if ($request->has('country') && $user->country !== $request->input('country')) {
            $user->country = $request->input('country');
        }

        $user->save();

        return $user;
    }
}
