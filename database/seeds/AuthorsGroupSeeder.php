<?php

use App\AuthorGroup;
use Illuminate\Database\Seeder;

class AuthorsGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AuthorGroup::truncate();

        AuthorGroup::insert([
            ["name" => AuthorGroup::PERSONS_GROUP_NAME],
            ["name" => AuthorGroup::MOVIES_GROUP_NAME],
            ["name" => AuthorGroup::PROVERBS_GROUP_NAME],
        ]);
    }
}
