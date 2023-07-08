<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyPerformanceScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('performance_scores', function (Blueprint $table) {
            $table->string('page_number')->nullable()->change();
            $table->string('href')->nullable()->change();
            $table->float('response_time')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('performance_scores', function (Blueprint $table) {
            $table->string('page_number')->nullable()->change();
            $table->string('href')->nullable()->change();
            $table->float('response_time')->nullable()->change();
        });
    }
}
