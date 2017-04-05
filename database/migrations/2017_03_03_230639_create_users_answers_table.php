<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('question_id');
            $table->unsignedInteger('option_id');
            $table->unsignedInteger('class_id');
            $table->unsignedInteger('type_id');
            $table->string('xtra');
            $table->string('answer');
            $table->date('answer_date');
            $table->timestamps();

            $table->unique(['user_id', 'question_id',  'class_id', 'type_id'], 'users_answers_unique_key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_answers');
    }
}
