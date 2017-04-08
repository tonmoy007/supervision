<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SarventQuestion extends Model
{
    protected $table = 'sarvent_questions';
    protected $fillable = [
        'user_id',
        'question_id',
        'serial_no',
        'answer',

    ];
}
