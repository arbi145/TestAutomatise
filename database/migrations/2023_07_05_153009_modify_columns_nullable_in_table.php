<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyColumnsNullableInTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tableau', function (Blueprint $table) {
            $table->string('value1')->nullable()->change();
            $table->string('value2')->nullable()->change();
            $table->string('value3')->nullable()->change();
            $table->string('value4')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tableau', function (Blueprint $table) {
            $table->string('value1')->nullable(false)->change();
            $table->string('value2')->nullable(false)->change();
            $table->string('value3')->nullable(false)->change();
            $table->string('value4')->nullable(false)->change();
        });
    }
}
