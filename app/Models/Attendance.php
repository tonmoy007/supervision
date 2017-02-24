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

   /* public function getTotalStudentsAttribute()
    {
        return "LOL";
        $school = User::find($this->school_id);
        return $school->name;
    }

    protected $appends = array('total_students');*/


    public function classes() {
        return $this->belongsTo('App\Models\Classes');
    }
}
