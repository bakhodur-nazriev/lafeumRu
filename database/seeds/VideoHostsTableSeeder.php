<?php

use App\VideoHost;
use Illuminate\Database\Seeder;

class VideoHostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VideoHost::truncate();

        VideoHost::create(['id' => VideoHost::UNKNOWN_HOST_TYPE_ID, 'name' => 'unknown']);
        VideoHost::create(['id' => VideoHost::YOUTUBE_HOST_TYPE_ID, 'name' => 'youtube']);
    }
}
