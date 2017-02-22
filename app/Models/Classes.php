<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $table = 'classes';
    protected $fillable = [
        'name',
        'total_students',
    ];

    public function school() {
        return $this->belongsTo('App\Models\School');
    }
}
