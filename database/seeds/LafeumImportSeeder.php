<?php

use App\Video;
use App\Author;
use App\Channel;
use App\Term;
use App\Knowledge;
use App\AuthorGroup;
use App\Quote;
use App\Category;
use Illuminate\Database\Seeder;

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
        $this->call(PhotoTableSeeder::class);

        $this->importAuthors();
        $this->importKnowledgeAreas();
        $this->importChannels();

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

        foreach ($authorGroups as $groupName => $authors) {

            $authorGroup = AuthorGroup::create(["name" => $groupName]);

            foreach ($authors as $author) {
                $author["author_group_id"] = $authorGroup->id;
                Author::create($author);
            }
        }
    }

    public function importChannels()
    {
        $channels = require(app_path("/LafeumData/lafeumChannels.php"));

        Channel::truncate();

        foreach ($channels as $channel) {
            Channel::create($channel);
        }
    }

    public function importKnowledgeAreas()
    {
        $knowledgeAreas = require(app_path("/LafeumData/lafeumKnowledge.php"));

        Knowledge::truncate();

        foreach ($knowledgeAreas as $knowledgeArea) {
            Knowledge::create($knowledgeArea);
        }
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

        foreach ($terms as $term) {
            $newTermData['id'] = $term['id'];
            $newTermData['body'] = $term['body'];

            echo $term['body'] . PHP_EOL;

            $termKnowledge = [];

            foreach ($term['knowledge_areas'] as $knowledgeArea){
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

    private function attachCategories($modelItem, $categoryNames, $categoryModel)
    {
        foreach ($categoryNames as $categoryName) {
            $modelItemCategories = Category::where('type', $categoryModel)
                ->where('name', $categoryName)
                ->first();

            $modelItem->categories()->save($modelItemCategories);
        }
    }
}
