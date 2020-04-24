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

        $this->importAuthors();
        $this->importChannels();
        $this->importKnowledgeAreas();
        $this->importPhotos();

        DB::table("categoriables")->truncate();

        $this->importVideos();
        $this->importQuotes();
        $this->importTerms();
    }

    public function importAuthors()
    {
        $authorGroups = require(app_path("/LafeumData/lafeumAuthors.php"));

        Author::truncate();
        AuthorGroup::truncate();

        $authorsToInsert = [];

        foreach ($authorGroups as $groupName => $authors) {

            $authorGroup = AuthorGroup::create(["name" => $groupName]);

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

        $this->insertChunked(Knowledge::class, $knowledgeAreas, true);
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

        Video::truncate();

        foreach ($videos as $video) {
            $newVideoData['id'] = $video['id'];
            $newVideoData['title'] = $video['title'];
            $newVideoData['duration'] = $video['duration'];
            $newVideoData['link'] = "https://www.youtube.com/embed/" . $video['video_id'];

            echo $video['title'] . PHP_EOL;

            $newVideoData['channel_id'] = Channel::where('slug', $video['channel']['slug'])->first()->id;

            $newVideo = Video::create($newVideoData);

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

        Term::truncate();
        DB::table('knowledge_terms')->truncate();

        foreach ($terms as $term) {
            $newTermData['id'] = $term['id'];
            $newTermData['name'] = $term['name'];
            $newTermData['link'] = $term['link'];
            $newTermData['body'] = $term['body'];

            echo $term['body'] . PHP_EOL;

            $termKnowledge = [];

            foreach ($term['knowledge_areas'] as $knowledgeArea) {
                $termKnowledge[] = Knowledge::where('slug', $knowledgeArea['slug'])->first()->id;
            }

            $newTerm = Term::create($newTermData);

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

        Quote::truncate();

        foreach ($quotes as $quote) {
            $newQuoteData['id'] = $quote['id'];
            $newQuoteData['body'] = $quote['body'];
            echo $quote['body'] . PHP_EOL;
            $newQuoteData['author_id'] = Author::where('slug', $quote['author']['slug'])->first()->id;

            $newQuote = Quote::create($newQuoteData);

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

        foreach ($chunked as $chunk) {
            $model::insert($chunk);
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
