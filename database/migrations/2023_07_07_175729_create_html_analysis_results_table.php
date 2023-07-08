<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHtmlAnalysisResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('html_analysis_results', function (Blueprint $table) {
            $table->id();
            $table->integer('performance_scores')->nullable();
            $table->integer('seo_score')->nullable();
            $table->integer('pwa_score')->nullable();
            $table->integer('accessibility_score')->nullable();
            $table->integer('best_practices_score')->nullable();
            $table->float('lcp_metric')->nullable();
            $table->float('cls_metric')->nullable();
            $table->float('fcp_metric')->nullable();
            $table->float('inp_metric')->nullable();
            $table->float('ttfb_metric')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('html_analysis_results');
    }
}
