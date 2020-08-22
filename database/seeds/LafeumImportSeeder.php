<?php

use App\Video;
use App\Author;
use App\Channel;
use App\Term;
use App\Knowledge;
use App\AuthorGroup;
use App\Quote;
use App\Category;
use App\Photo;
use App\Post;
use App\TermType;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LafeumImportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoryTableSeeder::class);
        $this->call(AuthorsGroupSeeder::class);

        $this->syncCategorySlugs();

        $this->importAuthors();
        $this->importChannels();
        $this->importKnowledgeAreas();
        $this->importPhotos();

        DB::table("categoriables")->truncate();

        $this->importVideos();
        $this->importQuotes();
        $this->importTerms();
    }

    public function syncCategorySlugs()
    {
        $categories = require(app_path("/LafeumData/lafeumCategorySlugs.php"));

        foreach ($categories as $category) {
            Category::where('name', $category['name'])->update(['slug' => $category['slug']]);
        }
    }

    public function importAuthors()
    {
        $authorGroups = require(app_path("/LafeumData/lafeumAuthors.php"));

        Author::truncate();
        AuthorGroup::truncate();

        $authorsToInsert = [];

        foreach ($authorGroups as $groupName => $authors) {

            $authorGroup = AuthorGroup::firstOrCreate(["name" => $groupName]);

            foreach ($authors as $author) {
                $author["author_group_id"] = $authorGroup->id;
                $authorsToInsert[] = $author;
            }
        }

        $this->insertChunked(Author::class, $authorsToInsert, true);
    }

    public function importChannels()
    {
        $channels = require(app_path("/LafeumData/lafeumChannels.php"));

        Channel::truncate();

        $this->insertChunked(Channel::class, $channels, true);
    }

    public function importKnowledgeAreas()
    {
        $knowledgeAreas = require(app_path("/LafeumData/lafeumKnowledge.php"));

        Knowledge::truncate();

        foreach ($knowledgeAreas as $knowledgeArea) {
            Knowledge::create($knowledgeArea);
        }
    }

    public function importPhotos()
    {
        $photos = require(app_path("/LafeumData/lafeumPhotos.php"));

        Photo::truncate();

        $preparedPhotos = [];

        foreach ($photos as $photo) {
            $preparedPhotos[] = [
                'path' => '/img/photos/' . $photo['file'],
                'description' => $photo['description']
            ];
        }

        $this->insertChunked(Photo::class, $preparedPhotos, true);
    }

    public function importVideos()
    {
        $videos = require(app_path("/LafeumData/lafeumVideos.php"));

        $collectionVideos = collect($videos);

        $reversedVideos = $collectionVideos->reverse();

        $reversedVideos->all();

        Video::truncate();

        foreach ($reversedVideos as $video) {
            $postExists = Post::where('id', $video['id'])->exists();

            if ($postExists) {
                continue;
            }

            $newVideoData['title'] = $video['title'];
            $newVideoData['duration'] = $video['duration'];
            $newVideoData['link'] = "https://youtu.be/" . $video['video_id'];

            echo $video['title'] . PHP_EOL;

            $newVideoData['channel_id'] = Channel::where('slug', $video['channel']['slug'])->first()->id;

            $newVideo = Video::create($newVideoData);

            $newVideo->post()->create(['id' => $video['id']]);

            $categoryNames = collect($video['categories'])->pluck('name');

            $this->attachCategories(
                $newVideo,
                $categoryNames,
                Video::class
            );
        }
    }

    public function importTerms()
    {
        $terms = require(app_path("/LafeumData/lafeumTerms.php"));

        $collectionTerms = collect($terms);

        $reversedTerms = $collectionTerms->reverse();

        $reversedTerms->all();

        Term::truncate();
        DB::table('knowledge_terms')->truncate();

        foreach ($reversedTerms as $term) {
            $postExists = Post::where('id', $term['id'])->exists();

            if ($postExists) {
                continue;
            }

            $newTermData['name'] = $term['name'];
            $newTermData['link'] = $term['link'];
            $newTermData['body'] = $term['body'];
            $newTermData['term_type'] = $term['term_types']['name'];
            $newTermData['show_in_vocabulary'] = $term['name'] ? true : false;

            echo $term['body'] . PHP_EOL;

            $termKnowledge = [];

            foreach ($term['knowledge_areas'] as $knowledgeArea) {
                $termKnowledge[] = Knowledge::where('name', $knowledgeArea['name'])->first()->id;
            }

            $newTerm = Term::create($newTermData);

            $newTerm->post()->create(['id' => $term['id']]);

            $newTerm->knowledge()->attach($termKnowledge);

            $categoryNames = collect($term['categories'])->pluck('name');

            $this->attachCategories(
                $newTerm,
                $categoryNames,
                Term::class
            );
        }
    }

    public function importQuotes()
    {
        $quotes = require(app_path("/LafeumData/lafeumQuotes.php"));

        $collectionQuotes = collect($quotes);

        $reversedQuotes = $collectionQuotes->reverse();

        $reversedQuotes->all();

        Quote::truncate();

        foreach ($reversedQuotes->reverse() as $quote) {
            $postExists = Post::where('id', $quote['id'])->exists();

            if ($postExists) {
                continue;
            }

            $newQuoteData['body'] = $quote['body'];
            echo $quote['body'] . PHP_EOL;
            $newQuoteData['author_id'] = Author::where('slug', $quote['author']['slug'])->first()->id;

            $newQuote = Quote::create($newQuoteData);

            $newQuote->post()->create(['id' => $quote['id']]);

            $categoryNames = collect($quote['categories'])->pluck('name');

            $this->attachCategories(
                $newQuote,
                $categoryNames,
                Quote::class
            );
        }
    }

    /**
     * Helpers
     */

    private function attachCategories($modelItem, $categoryNames, $categoryModel)
    {
        foreach ($categoryNames as $categoryName) {
            $modelItemCategories = Category::where('type', $categoryModel)
                ->where('name', $categoryName)
                ->first();

            $modelItem->categories()->save($modelItemCategories);
        }
    }

    private function insertChunked($model, $dataToChunk, $withTimestamps = false, $size = 100)
    {
        if ($withTimestamps) {
            $dataToChunk = $this->addDefaultTimestamps($dataToChunk);
        }

        $chunked = array_chunk($dataToChunk, $size);

        $tableName = (new $model())->getTable();

        foreach ($chunked as $chunk) {
            DB::table($tableName)->insert($chunk);
        }
    }

    private function addDefaultTimestamps($array)
    {
        $itemsWithTimestamps = [];

        foreach ($array as $item) {
            $item["created_at"] = Carbon::now()->toDateTimeString();
            $item["updated_at"] = Carbon::now()->toDateTimeString();
            $itemsWithTimestamps[] = $item;
        }

        return $itemsWithTimestamps;
    }
}
