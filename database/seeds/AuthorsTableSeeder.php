<?php

use Illuminate\Database\Seeder;
use App\Authors;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Authors', 200)->create();
    }
}
