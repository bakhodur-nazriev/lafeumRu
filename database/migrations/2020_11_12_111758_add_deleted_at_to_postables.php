<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToPostables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::table('terms', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::table('videos', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::table('photos', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable();
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
            $table->dropColumn('deleted_at');
        });

        Schema::table('terms', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('videos', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('photos', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
    }
}
