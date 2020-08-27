<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        User::truncate();

        $adminRoleId = Role::where("name", Role::ADMIN_ROLE_NAME)->first()->id;
        $authorRoleId = Role::where("name", Role::AUTHOR_ROLE_NAME)->first()->id;
        $memberRoleId = Role::where("name", Role::MEMBER_ROLE_NAME)->first()->id;

        User::create([
            "name" => "Admin",
            "email" => "anvardzhabarov@gmail.com",
            "password" => Hash::make("i6QSDNVcDd6g4XOwwdfL"),
            "role_id" => $adminRoleId
        ]);

        // User::create([
        //     "name" => "Author",
        //     "email" => "author@gmail.com",
        //     "password" => Hash::make("pass"),
        //     "role_id" => $authorRoleId
        // ]);

        // User::create([
        //     "name" => "Member",
        //     "email" => "member@gmail.com",
        //     "password" => Hash::make("pass"),
        //     "role_id" => $memberRoleId
        // ]);

    }
}
