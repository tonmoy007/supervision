<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $table = 'classes';
    protected $fillable = [
        'name',
        'total_students',
        'school_id'
    ];

    public function getSchoolNameAttribute()
    {
       $school = User::find($this->school_id);
        return $school->name;
    }

    protected $appends = array('school_name'/*, 'is_attendance_taken'*/);

    public function school() {
        return $this->belongsTo('App\Models\School');
    }

    public function attendances() {
        return $this->hasMany('App\Models\Attendance');
    }

    public function getAttandance() {
        return Classes::find($this->id)->attendances;
    }

}
