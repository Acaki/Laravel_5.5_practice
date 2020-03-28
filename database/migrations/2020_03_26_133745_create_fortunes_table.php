<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFortunesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fortunes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('constellation');
            $table->date('date');
            $table->integer('overall_fortune_score');
            $table->string('overall_fortune_description');
            $table->integer('love_fortune_score');
            $table->string('love_fortune_description');
            $table->integer('career_fortune_score');
            $table->string('career_fortune_description');
            $table->integer('wealth_fortune_score');
            $table->string('wealth_fortune_description');
            $table->index(['constellation', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fortunes');
    }
}
