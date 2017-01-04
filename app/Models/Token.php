<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    //
    protected $table = 'tokens';
    protected $filable=['token','user_id'];
    protected $hidde=['id','created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
