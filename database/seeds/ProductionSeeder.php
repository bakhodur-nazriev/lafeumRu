<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->seedAdmin();
        $this->call(VideoHostsTableSeeder::class);
        $this->call(LafeumImportSeeder::class);
    }

    public function seedAdmin()
    {
        $adminRoleId = Role::where("name", Role::ADMIN_ROLE_NAME)->first()->id;

        $adminName = env('ADMIN_NAME', 'Admin');
        $adminEmail = env('ADMIN_EMAIL', 'admin@gmail.com');
        $adminPassword = env('ADMIN_PASSWORD', 'pass');

        User::create([
            "name" => $adminName,
            "email" => $adminEmail,
            "password" => Hash::make($adminPassword),
            "role_id" => $adminRoleId
        ]);
    }
}
