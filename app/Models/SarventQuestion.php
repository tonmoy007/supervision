<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SarventQuestion extends Model
{
    protected $table = 'sarvent_questions';
    protected $fillable = [
        'user_id',
        'serial_no',
        'responsible',
        'total_school',
        'present_school'
    ];
}
