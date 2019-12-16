<?php

use Illuminate\Database\Seeder;
use App\Term;

class TermTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         factory(Term::class, 30)->create();
    }
}
