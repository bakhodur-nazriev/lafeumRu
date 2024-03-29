<?php

namespace App\Http\Controllers;

use App\Author;
use App\AuthorGroup;
use App\Quote;
use App\Services\RedirectService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorsController extends Controller
{
    const AUTHORS_PHOTOS_PATH = "/img/authors/";

    protected $redirectService;

    public function __construct(RedirectService $redirectService)
    {
        $this->authorizeResource(Author::class);
        $this->redirectService = $redirectService;
    }

    public function index()
    {
        return view("/authors");
    }

    public function show(Author $author)
    {
        $currentAuthor = $author;

        return view('shows.author', compact(['currentAuthor']));
    }

    public function showMovies()
    {
        $currentAuthor = new Author([
            "name" => AuthorGroup::MOVIES_GROUP_NAME,
            "biography" => "Фильмы и Сериалы. Здесь собраны лучшие высказывания и цитаты из фильмов и сериалов всех времен."
        ]);

        return view('shows.author', compact(['currentAuthor']));
    }

    public function showProverbs()
    {
        $currentAuthor = new Author([
            "name" => AuthorGroup::PROVERBS_GROUP_NAME,
            "biography" => "Пословицы и поговорки. Коллекция пословиц и поговорок народов мира. В них собраны плоды опытности народов и здравый смысл."
        ]);

        return view('shows.author', compact(['currentAuthor']));
    }

    public function getAuthors()
    {
        $authors = $this->getPersonsList();

        return response()->json(collect($authors));
    }

    public function getShowAuthor(Author $author)
    {
        switch ($author->authorGroup->name) {

            case AuthorGroup::MOVIES_GROUP_NAME:
                $authorListTitle = ['group_name' => AuthorGroup::MOVIES_GROUP_NAME];
                $authors = Author::movies()->orderBy('name')->paginate(30);
                break;

            case AuthorGroup::PROVERBS_GROUP_NAME:
                $authorListTitle = ['group_name' => AuthorGroup::PROVERBS_GROUP_NAME];
                $authors = Author::proverbs()->orderBy('name')->paginate(30);
                break;

            default:
                $authorListTitle = ['group_name' => 'Авторы'];
                $authors = Author::persons()->orderBy('name')->paginate(30);
                break;
        }

        $currentAuthor = $author;

        $currentAuthor->quotes = $currentAuthor
            ->quotes()
            ->published('desc')
            ->with('categories', 'post', 'author')
            ->paginate(20);

        return response()->json(collect([$authors, $authorListTitle, $currentAuthor]));
    }

    public function getShowMovies()
    {
        $authors = Author::movies()->orderBy('name')->paginate(30);

        $authorListTitle = ["group_name" => AuthorGroup::MOVIES_GROUP_NAME];

        $currentAuthor = new Author([
            "name" => AuthorGroup::MOVIES_GROUP_NAME,
            "biography" => "Фильмы и Сериалы. Здесь собраны лучшие высказывания и цитаты из фильмов и сериалов всех времен."
        ]);

        $movieIds = Author::movies()->orderBy('name')->get()->pluck('id');

        $currentAuthor->quotes = Quote::with(
            'categories:id,name,slug',
            'post:id,postable_id',
            'author:id,name,slug'
        )
            ->orderBy('id', 'desc')
            ->whereIn('author_id', $movieIds)
            ->paginate(20);

        return response()->json(collect([$authors, $authorListTitle, $currentAuthor]));
    }

    public function getShowProverbs()
    {
        $authors = Author::proverbs()->orderBy('name')->paginate(30);
        $authorListTitle = ["group_name" => AuthorGroup::PROVERBS_GROUP_NAME];

        $currentAuthor = new Author([
            "name" => AuthorGroup::PROVERBS_GROUP_NAME,
            "biography" => "Пословицы и поговорки. Коллекция пословиц и поговорок народов мира. В них собраны плоды опытности народов и здравый смысл."
        ]);

        $proverbIds = Author::proverbs()->orderBy('name')->get()->pluck('id');

        $currentAuthor->quotes = Quote::with('categories', 'post', 'author')
            ->orderBy('id', 'desc')
            ->whereIn('author_id', $proverbIds)
            ->paginate(20);

        return response()->json(collect([$authors, $authorListTitle, $currentAuthor]));
    }

    public function get(Request $request)
    {
        $authorsQuery = Author::orderBy('name', 'asc');
        return $this->processIndexRequestItems($request, $authorsQuery, 'name');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'author_group_id' => 'required'
        ]);

        $newAuthorData = $request->all();

        if ($request->hasFile("photo")) {
            $newAuthorData["photo"] = $this->saveImage(time(), $request->photo, self::AUTHORS_PHOTOS_PATH);
        }

        return Author::create($newAuthorData);
    }

    public function update(Author $author, Request $request)
    {
        $newPhotoData = $request->only(["name", "biography"]);
        if ($request->hasFile("photo")) {
            $newPhotoData["photo"] = $this->saveImage(time(), $request->photo, self::AUTHORS_PHOTOS_PATH);
        }
        $author->update($newPhotoData);
        return $author;
    }

    public function destroy(Author $author)
    {
        $author->delete();
    }

    /**
     * Helpers
     *
     */
    private function getPersonsList()
    {
        $authors = Author::persons()
            ->orderBy('name', 'asc')
            ->get();

        $authors->prepend(new Author([
            "name" => AuthorGroup::PROVERBS_GROUP_NAME,
            "slug" => "poslovicy-i-pogovorki"
        ]));

        $authors->prepend(new Author([
            "name" => AuthorGroup::MOVIES_GROUP_NAME,
            "slug" => "filmy-i-serialy"
        ]));

        return $authors;
    }

    public function getTrashed(Request $request)
    {
        $authorsTrashedQuery = Author::onlyTrashed()->orderBy('name', 'asc');
        return $this->processIndexRequestItems($request, $authorsTrashedQuery, 'name');
    }

    public function restored($id)
    {
        $author = Author::onlyTrashed()->find($id);
        $author->restore();
    }

    public function forceDeleted($id)
    {
        $author = Author::onlyTrashed()->find($id);

        $this->redirectService->registerModelRemoval($author);

        $author->forceDelete();
    }
}
