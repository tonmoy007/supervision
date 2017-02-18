<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinkCategory extends Model
{
    protected $table = 'link_categories';
    protected $fillable = [
        'category'
    ];
}
