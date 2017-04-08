<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSarventQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sarvent_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('ক্রমিক নং');
            $table->string('ক্লাস্টারের দায়িত্বপ্রাপ্ত কর্মকর্তার নাম ও পদবী');
            $table->string('ক্লাস্টার ভুক্ত মোট শিক্ষা প্রতিষ্ঠানের সংখ্যা');
            $table->string('রিপোর্টিং মাসে পরিদর্শণকৃত শিক্ষা প্রতিষ্ঠানের সংখ্যা');
            $table->timestamps();
            $table->unique(['user_id', 'ক্রমিক নং'], 'sarvent_answers_unique_key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sarvent_questions');
    }
}
