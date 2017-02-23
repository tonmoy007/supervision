<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendances';
    protected $fillable = [
        'present_students',
        'present_date',
    ];

    public function school() {
        return $this->belongsTo('App\Models\Classes');
    }
}
