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
        $this->importChannels();
        $this->importAuthors();
        $this->call(PhotoTableSeeder::class);
        $this->call(CategoryTableSeeder::class);

//      $this->importVideos();
        $this->importKnowledgeAreas();
        /*$this->importTerms();*/
        $this->importQuotes();
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
            Video::create($video);
        }

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

    public function importTerms()
    {
        $terms = require(app_path("/LafeumData/lafeumTerms.php"));

        Term::truncate();

        foreach ($terms as $term) {
            $newTermData['id'] = $term['id'];
            $newTermData['name'] = $term['name'];
            $newTermData['body'] = $term['body'];

            $newTerm = Term::create($newTermData);

            foreach ($term['categories'] as $category) {
                $newTermCategory = Category::where('type', Term::class)
                    ->where('name', $category['name'])
                    ->first();

                $newTerm->categories->save($newTermCategory);
            }
        }
    }

    public function importQuotes()
    {
        $quotes = require(app_path("/LafeumData/lafeumQuotes.php"));

        Quote::truncate();

        foreach ($quotes as $quote) {
            $newQuoteData['id'] = $quote['id'];
            $newQuoteData['body'] = $quote['body'];
            $newQuoteData['author_id'] = Author::where('name', $quote['author']['name'])->first()->id;

            $newQuote = Quote::create($newQuoteData);

            foreach ($quote['categories'] as $category) {
                $newQuoteCategory = Category::where('type', Quote::class)
                    ->where('name', $category['name'])
                    ->first();

                $newQuote->categories()->save($newQuoteCategory);
            }
        }
    }
}
