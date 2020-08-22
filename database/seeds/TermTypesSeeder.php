<?php

use App\TermType;
use Illuminate\Database\Seeder;

class TermTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TermType::truncate();

        TermType::insert([
            ["name" => TermType::SCIENTIFIC_TERMS],
            ["name" => TermType::EXPERT_COMMENTS],
        ]);
    }
}
