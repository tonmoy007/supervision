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

   public function getTotalStudentsAttribute()
    {
        $class = Classes::whereHas("attendances", function($query) {
            $query->where('id', $this->id);})->first();
        return $class->total_students;
    }

    public function getAbsentStudentsAttribute() {
        return $this->getTotalStudentsAttribute()-$this->present_students;
    }

    public function getClassNameAttribute() {
        $class = Classes::whereHas("attendances", function($query) {
            $query->where('id', $this->id);})->first();
        return $class->name;
    }
    protected $appends = array('total_students','absent_students', 'class_name');


    public function classes() {
        return $this->belongsTo('App\Models\Classes');
    }
}
