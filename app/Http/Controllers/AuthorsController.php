<?php

namespace App\Http\Controllers;

use App\Author;
use App\AuthorGroup;
use App\Category;
use App\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorsController extends Controller
{
    const AUTHORS_PHOTOS_PATH = "/img/authors/";

    public function __construct() {
        $this->authorizeResource(Author::class);
    }

    public function index()
    {
        $authors = $this->getPersonsList();

        return view("/authors", compact("authors"));
    }

    public function show(Author $author)
    {
        switch ($author->authorGroup->name) {

            case AuthorGroup::MOVIES_GROUP_NAME:
                $authorListTitle = AuthorGroup::MOVIES_GROUP_NAME;
                $authors = Author::movies()->get();
                break;

            case AuthorGroup::PROVERBS_GROUP_NAME:
                $authorListTitle = AuthorGroup::PROVERBS_GROUP_NAME;
                $authors = Author::proverbs()->get();
                break;

            default:
                $authorListTitle = 'Авторы';
                $authors = $this->getPersonsList();
                break;
        }

        $currentAuthor = $author;
        $currentAuthor->quotes = $currentAuthor
            ->quotes()
            ->orderby('id', 'desc')
            ->with('categories')
            ->paginate(30);

        return view('shows.author', compact(['authors', 'authorListTitle', 'currentAuthor']));
    }

    public function showMovies()
    {
        $authors = Author::movies()->get();
        $authorListTitle = AuthorGroup::MOVIES_GROUP_NAME;

        $currentAuthor = new Author([
            "name" => AuthorGroup::MOVIES_GROUP_NAME,
            "biography" => "Фильмы и Сериалы. Здесь собраны лучшие высказывания и цитаты из фильмов и сериалов всех времен."
        ]);

        $movieIds = $authors->pluck('id');

        $currentAuthor->quotes = Quote::with('categories')->orderBy('id','desc')->whereIn('author_id', $movieIds)->get();

        return view('shows.author', compact(['authors', 'authorListTitle', 'currentAuthor']));
    }

    public function showProverbs()
    {
        $authors = Author::proverbs()->get();
        $authorListTitle = AuthorGroup::PROVERBS_GROUP_NAME;

        $currentAuthor = new Author([
            "name" => AuthorGroup::PROVERBS_GROUP_NAME,
            "biography" => "Пословицы и поговорки. Коллекция пословиц и поговорок народов мира. В них собраны плоды опытности народов и здравый смысл."
        ]);

        $proverbIds = $authors->pluck('id');

        $currentAuthor->quotes = Quote::with('categories')->orderBy('id','desc')->whereIn('author_id', $proverbIds)->get();

        return view('shows.author', compact(['authors', 'authorListTitle', 'currentAuthor']));
    }

    public function get(Request $request)
    {
        $authorsQuery = Author::orderBy('name','asc');
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
            ->orderBy('name','asc')
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
}
