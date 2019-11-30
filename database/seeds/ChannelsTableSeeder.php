<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Channels', 10)->create();
    }
}
