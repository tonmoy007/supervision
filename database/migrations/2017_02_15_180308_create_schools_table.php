<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->increments('id');
            /*$table->string('name');
            $table->string('email')->unique();
            $table->string('password');*/
            $table->string('category')->nullable();
            $table->integer('teacher')->default(0);
            $table->integer('female_teacher')->default(0);
            $table->string('upozilla')->nullable();
            $table->string('zilla')->nullable();
            $table->string('management')->nullable();
            $table->string('type')->nullable();
            $table->string('mpo_code')->nullable();
            $table->date('mpo_date')->nullable();
            $table->string('eiin_number')->nullable();
            $table->unsignedInteger('user_id')->default(1)->foreign()->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('schools');
    }
}
