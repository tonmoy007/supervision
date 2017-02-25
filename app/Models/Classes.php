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

    public function getPresentStudentsAttribute()
    {

        $today = Carbon::now()->toDateString();
        $attendance = Classes::find($this->id)->attendances()->where('present_date', $today)->first();
        if($attendance == null) {
            return 0;
        }
        return $attendance->present_students;
    }

    protected $appends = array('school_name', 'present_students');

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
