<?php

namespace App\Models;

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

    protected $appends = array('school_name');

    public function school() {
        return $this->belongsTo('App\Models\School');
    }

    public function attendances() {
        return $this->hasMany('App\Models\Attendance');
    }

}
