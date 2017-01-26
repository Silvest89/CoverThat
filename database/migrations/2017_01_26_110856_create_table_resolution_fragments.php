<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableResolutionFragments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resolution_fragments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('resolution_id');
            $table->timestamps();

            $table->foreign('resolution_id')->references('id')->on('video_resolutions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('resolution_fragments', function (Blueprint $table) {
            $table->dropForeign('resolution_id');
        });
    }
}
