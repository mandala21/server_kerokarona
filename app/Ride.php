<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    protected $table = 'ride';

    protected $fillables = [
        'user_id',
        'from',
        'to',
        'hour',
        'day',
        'spaces'
    ];

    function user(){
        return $this->hasOne('App\User','id','user_id');
    }
}
