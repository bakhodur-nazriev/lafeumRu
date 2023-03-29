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

    /*public function getById(int $id): JsonResponse
    {
        $favoritesQuotes = Favorite::with(['quotes' => function ($q) {
            $q->with(
                'author:id,name,slug',
                'categories:id,name,slug',
                'post'
            );
        }])
            ->where('user_id', '=', $id)
            ->where('favorited_type', '=', 'App\\Quote')
            ->get();

        $favoritesTerms = Favorite::with(['terms' => function ($q) {
            $q->with([
                "categories",
                "favorites",
                "termType",
                "post"
            ]);
        }])
            ->where('user_id', '=', $id)
            ->where('favorited_type', '=', 'App\\Term')
            ->get();

        $favoritesVideos = Favorite::with(['videos' => function ($q) {
            $q->with([
                "categories",
                "channel",
                "post"
            ]);
        }])
            ->where('user_id', '=', $id)
            ->where('favorited_type', '=', 'App\\Video')
            ->get();

        return response()->json([
            'favorited_quotes' => $favoritesQuotes,
            'favorited_terms' => $favoritesTerms,
            'favorited_videos' => $favoritesVideos
        ]);
    }*/

    public function getById(int $id): JsonResponse
    {
        $favorites = [
            'favorited_quotes' => Favorite::with(['quotes.author:id,name,slug', 'quotes.categories:id,name,slug', 'quotes.post'])
                ->where('user_id', '=', $id)
                ->where('favorited_type', '=', 'App\Quote')
                ->get(),
            'favorited_terms' => Favorite::with(['terms.categories', 'terms.favorites', 'terms.termType', 'terms.post'])
                ->where('user_id', '=', $id)
                ->where('favorited_type', '=', 'App\Term')
                ->get(),
            'favorited_videos' => Favorite::with(['videos.categories', 'videos.channel', 'videos.post'])
                ->where('user_id', '=', $id)
                ->where('favorited_type', '=', 'App\Video')
                ->get(),
        ];

        return response()->json($favorites);
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
