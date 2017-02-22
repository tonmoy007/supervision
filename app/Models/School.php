<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table = 'schools';
    protected $fillable = [
        /*'name',
        'email',
        'password',*/
        'category',
        'teacher',
        'female_teacher',
        'upozilla',
        'zilla',
        'management',
        'type',
        'mpo_code',
        'mpo_date',
        'eiin_number',
        'user_id'
    ];

    public function getMaleTeacherAttribute()
    {
        return  $this->teacher - $this->female_teacher;
    }

    protected $appends = array('male_teacher');


    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function classes() {
        return $this->hasMany('App\Models\Classes');
    }

    public static function boot()
    {
        parent::boot();
        /* static::creating(function () {
             $lastElm = DB::table('single_post')->orderBy('id', 'desc')->first();
             if(!empty($lastElm)){
                 $id = (string) ($lastElm->id + 1);
             } else {
                 $id = "1";
             }
         });*/
    }

    public static function getById($id) {
        return School::where('id', $id)->first();
    }
}
