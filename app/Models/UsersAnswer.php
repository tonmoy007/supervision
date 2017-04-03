<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersAnswer extends Model
{
    protected $table = 'users_answers';
    protected $fillable = [
        'user_id',
        'question_id',
        'option_id',
        'class_id',
        'type_id',
        'answer',
        'xtra',
        'answer_date',
    ];
   /*
    *  $table->unsignedInteger('user_id');
            $table->unsignedInteger('question_id');
            $table->unsignedInteger('option_id');
            $table->unsignedInteger('class_id')->default(0);
            $table->string('xtra');
            $table->string('answer');
            $table->date('answer_date');
    */
}
