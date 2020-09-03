<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPublishAtToPostables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->timestamp('publish_at')->useCurrent();
        });

        Schema::table('terms', function (Blueprint $table) {
            $table->timestamp('publish_at')->useCurrent();
        });

        Schema::table('videos', function (Blueprint $table) {
            $table->timestamp('publish_at')->useCurrent();
        });

        Schema::table('photos', function (Blueprint $table) {
            $table->timestamp('publish_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->dropColumn('publish_at');
        });

        Schema::table('terms', function (Blueprint $table) {
            $table->dropColumn('publish_at');
        });

        Schema::table('videos', function (Blueprint $table) {
            $table->dropColumn('publish_at');
        });

        Schema::table('photos', function (Blueprint $table) {
            $table->dropColumn('publish_at');
        });
    }
}
