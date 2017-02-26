<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoticeSeen extends Model
{
    protected $table = 'notice_seen';
    protected $fillable = [
        'user_id',
        'notice_id',
        'is_seen'
    ];
}
