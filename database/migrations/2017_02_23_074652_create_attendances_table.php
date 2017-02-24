<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('classes_id')->default(1)->foreign()->references('id')->on('classes')->onDelete('cascade');
            $table->integer('present_students')->default(0);
            $table->date('present_date')->default(\Carbon\Carbon::now());
            $table->unsignedInteger('present_by');
            $table->timestamps();

            $table->unique(['classes_id', 'present_date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
