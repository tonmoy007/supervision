<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $table = 'notices';
    protected $fillable = [
        'title',
        'description',
        'notice_file'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
