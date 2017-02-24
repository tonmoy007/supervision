<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendances';
    protected $fillable = [
        'present_students',
        'present_date',
        'present_by'
    ];

    public function classes() {
        return $this->belongsTo('App\Models\Classes');
    }
}
