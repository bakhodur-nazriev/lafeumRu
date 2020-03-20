<?php

use App\Author;
use App\Channel;
use App\Knowledge;
use App\AuthorGroup;
use App\Quote;
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
        $this->importKnowledgeAreas();
        $this->importAuthors();
    }

    public function importChannels()
    {
        $channels = require(app_path('/LafeumData/lafeumChannels.php'));

        Channel::truncate();

        foreach ($channels as $channel) {
            Channel::create($channel);
        }
    }

    public function importKnowledgeAreas()
    {
        $knowledgeAreas = require(app_path('/LafeumData/lafeumKnowledge.php'));

        Knowledge::truncate();

        foreach ($knowledgeAreas as $knowledgeArea) {
            Knowledge::create($knowledgeArea);
        }
    }

    public function importAuthors()
    {
        $authorGroups = require(app_path('/LafeumData/lafeumAuthors.php'));

        Author::truncate();
        AuthorGroup::truncate();

        foreach ($authorGroups as $groupName => $authors) {

            $authorGroup = AuthorGroup::create(['name' => $groupName]);

            foreach ($authors as $author) {
                $author['author_group_id'] = $authorGroup->id;
                Author::create($author);
            }

        }
    }

    public function importQuotes()
    {
        $quotes = require(app_path('/LafeumData/lafeumQuotes.php'));

        Quote::truncate();


    }
}
