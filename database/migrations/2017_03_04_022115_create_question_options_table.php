<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options_questions', function (Blueprint $table) {
            $table->integer('questions_id')->unsigned()->nullable();
            $table->foreign('questions_id')->references('id')
                ->on('questions')->onDelete('cascade');

            $table->integer('options_id')->unsigned()->nullable();
            $table->foreign('options_id')->references('id')
                ->on('options')->onDelete('cascade');
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
        Schema::dropIfExists('options_questions');
    }
}
