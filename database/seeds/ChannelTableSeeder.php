<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ChannelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Channel', 10)->create();
    }
}
