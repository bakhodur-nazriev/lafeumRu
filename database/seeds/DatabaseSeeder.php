<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(ChannelsTableSeeder::class);
        $this->call(PhotosTableSeeder::class);
        $this->call(AuthorsTableSeeder::class);
        $this->call(KnowledgeAreasTableSeeder::class);
        $this->call(TermsTableSeeder::class);
    }
}
