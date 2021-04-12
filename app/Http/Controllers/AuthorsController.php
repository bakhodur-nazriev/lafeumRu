<?php

namespace App\Http\Controllers;

use App\Author;
use App\AuthorGroup;
use App\Quote;
use App\Services\RedirectService;
use Illuminate\Http\Request;

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

    public function getAuthors()
    {
        $authors = $this->getPersonsList();
        
        return response()->json(collect($authors));
    }

    public function show(Author $author)
    {
        switch ($author->authorGroup->name) {

            case AuthorGroup::MOVIES_GROUP_NAME:
                $authorListTitle = AuthorGroup::MOVIES_GROUP_NAME;
                $authors = Author::movies()->orderBy('name', 'asc')->get();
                break;

            case AuthorGroup::PROVERBS_GROUP_NAME:
                $authorListTitle = AuthorGroup::PROVERBS_GROUP_NAME;
                $authors = Author::proverbs()->orderBy('name', 'asc')->get();
                break;

            default:
                $authorListTitle = 'Авторы';
                $authors = $this->getPersonsList();
                break;
        }

        $currentAuthor = $author;
        $currentAuthor->quotes = $currentAuthor
            ->quotes()
            ->published('desc')
            ->with('categories')
            ->paginate(30);

        return view('shows.author', compact(['authors', 'authorListTitle', 'currentAuthor']));
    }

    public function showMovies()
    {
        $authors = Author::movies()->orderBy('name', 'asc')->get();
        $authorListTitle = AuthorGroup::MOVIES_GROUP_NAME;

        $currentAuthor = new Author([
            "name" => AuthorGroup::MOVIES_GROUP_NAME,
            "biography" => "Фильмы и Сериалы. Здесь собраны лучшие высказывания и цитаты из фильмов и сериалов всех времен."
        ]);

        $movieIds = $authors->pluck('id');

        $currentAuthor->quotes = Quote::with('categories')
            ->orderBy('id', 'desc')
            ->whereIn('author_id', $movieIds)
            ->paginate(30);

        return view('shows.author', compact(['authors', 'authorListTitle', 'currentAuthor']));
    }

    public function showProverbs()
    {
        $authors = Author::proverbs()->orderBy('name', 'asc')->get();
        $authorListTitle = AuthorGroup::PROVERBS_GROUP_NAME;

        $currentAuthor = new Author([
            "name" => AuthorGroup::PROVERBS_GROUP_NAME,
            "biography" => "Пословицы и поговорки. Коллекция пословиц и поговорок народов мира. В них собраны плоды опытности народов и здравый смысл."
        ]);

        $proverbIds = $authors->pluck('id');

        $currentAuthor->quotes = Quote::with('categories')
            ->orderBy('id', 'desc')
            ->whereIn('author_id', $proverbIds)
            ->paginate(30);

        return view('shows.author', compact(['authors', 'authorListTitle', 'currentAuthor']));
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
