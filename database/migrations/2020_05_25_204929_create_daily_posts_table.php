<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \Illuminate\Support\Carbon;

class CreateDailyPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->integer('quote_id');
            $table->integer('term_id');
            $table->integer('video_id');
            $table->integer('photo_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_posts');
    }
}
