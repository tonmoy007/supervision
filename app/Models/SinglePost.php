<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SinglePost extends Model
{
    protected $table = 'posts';
    protected $fillable = [
        'title',
        'type',
        'subtitle',
        'content'
    ];

    public function users(){
        return $this->belongsTo('App\Models\User');
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
        return Product::where('id', $id)->first();
    }

}
