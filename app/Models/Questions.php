<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $table = 'questions';
    protected $fillable = [
        'question',
        'type',
    ];
    public function options()
    {
        return $this->belongsToMany('App\Models\Options')
            ->withTimestamps();
    }
}
