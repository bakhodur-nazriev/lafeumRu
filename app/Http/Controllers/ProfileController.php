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
        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'email' => 'email|max:255',
            'age' => 'integer',
            'gender' => 'string|in:male,female',
            'password' => 'string|min:6',
            'avatar' => 'image|max:2048',
            'country' => 'string|max:255',
        ]);

        $user->update($validatedData);

        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('avatar')) {
            $user->avatar = $this->saveImage(time(), $request->file('avatar'), self::USERS_AVATARS_PATH);
        }

        $user->save();

        return $user;
    }
}
