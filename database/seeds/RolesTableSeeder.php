<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();
        Role::create(["name" => Role::ADMIN_ROLE_NAME]);
        Role::create(["name" => Role::AUTHOR_ROLE_NAME]);
        Role::create([
            "id" => Role::MEMBER_ROLE_ID, 
            "name" => Role::MEMBER_ROLE_NAME
        ]);
    }
}
