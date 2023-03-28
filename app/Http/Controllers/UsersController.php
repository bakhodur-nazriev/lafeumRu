<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Role;
use App\User;
use App\Quote;
use App\Category;
use Gate;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

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

    public function getById(int $id): JsonResponse
    {
        $favoritesPosts = Favorite::with(['quotes' => function ($q) {
            $q->with([
                'author:id,name,slug',
                'categories:id,name,slug',
                'post'
            ]);
        }])
            ->where('user_id', '=', $id)
            ->get();

        $user = User::with("role")
            ->whereId($id)
            ->first();

        return response()->json([
            'user' => $user,
            'favorites_posts' => $favoritesPosts,
        ]);
    }

    public function update(User $user, Request $request)
    {
        $updatedUserData = $request->only(["name", "email", "country", "age", "gender", "hobby"]);

        if ($request->hasFile("avatar")) {
            $updatedUserData['avatar'] = $this->saveImage(time(), $request->avatar, self::USERS_AVATARS_PATH);
        }

        if ($request->has('password')) {
            $updatedUserData['password'] = Hash::make($request->password);
        }

        $user->update($updatedUserData);

        $authIsAdmin = auth()->user()->hasRole(Role::ADMIN_ROLE_NAME);

        if ($authIsAdmin && $request->role_id) {
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
