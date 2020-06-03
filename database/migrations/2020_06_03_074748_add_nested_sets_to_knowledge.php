<?php

use App\Knowledge;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kalnoy\Nestedset\NestedSet;

class AddNestedSetsToKnowledge extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('knowledge', function (Blueprint $table) {
            NestedSet::columns($table);
        });
        
        Knowledge::fixTree();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('knowledge', function (Blueprint $table) {
            NestedSet::dropColumns($table);
        });
    }
}
