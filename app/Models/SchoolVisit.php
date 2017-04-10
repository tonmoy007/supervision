<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolVisit extends Model
{
    protected $table = 'school_visits';
    protected $fillable = [
        'visitor_id',
        'school_id',
        'visit_date'
    ];
}
