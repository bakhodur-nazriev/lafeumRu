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
        $this->call(UsersTableSeeder::class);
        $this->call(ChannelTableSeeder::class);
        $this->call(PhotoTableSeeder::class);
        $this->call(AuthorTableSeeder::class);
        $this->call(KnowledgeTableSeeder::class);
        $this->call(TermTableSeeder::class);
        $this->call(VideoTableSeeder::class);
        $this->call(QuoteTableSeeder::class);
        $this->call(TagTableSeeder::class);
    }
}
