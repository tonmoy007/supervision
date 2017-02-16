<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'sliders';
    protected $fillable = [
        'image',
        'description',
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
        return Product::where('id', $id)->first();
    }
}
