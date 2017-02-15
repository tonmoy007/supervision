<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = 'links';
    protected $fillable = [
        'name',
        'type',
        'url'
    ];
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
        return Employee::where('id', $id)->first();
    }
}
