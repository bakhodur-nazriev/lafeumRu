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
        DB::table("role_user")->truncate();

        $adminRole = Role::where("name", "admin")->first();
        $authorRole = Role::where("name", "author")->first();
        $memberRole = Role::where("name", "member")->first();

        $admin = User::create([
            "name" => "Admin User",
            "email" => "admin@gmail.com",
            "password" => Hash::make("pass")
        ]);

        $author = User::create([
            "name" => "Author User",
            "email" => "author@gmail.com",
            "password" => Hash::make("pass")
        ]);

        $member = User::create([
            "name" => "Member User",
            "email" => "member@gmail.com",
            "password" => Hash::make("pass")
        ]);

        $admin->roles()->attach($adminRole);
        $author->roles()->attach($authorRole);
        $member->roles()->attach($memberRole);
    }
}
