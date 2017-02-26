<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->default(1)->foreign()->references('id')->on('users')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->string("notice_file");
            $table->timestamps();
        });

        Schema::create('notice_seen', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('notice_id');
            $table->boolean('is_seen');
            $table->timestamps();
            $table->unique(['user_id', 'notice_id']);
        });
    }
/*
 * User_id
Title
Description
Notice_file(pdf,doc,text,ppt)
 */
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notices');
        Schema::dropIfExists('notice_seen');
    }
}
