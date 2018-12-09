<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    protected $table = 'ride';

    protected $fillable = [
        'user_id',
        'from',
        'to',
        'hour',
        'day',
        'spaces',
        'price',
    ];

    /**
     * Relationship with User
     * 
     * @return Relationship
     */
    function user(){
        return $this->hasOne('App\User','id','user_id');
    }

    /** 
     * Mutator of day value
     *
     * @param Date $value
     * @return Array
     */
    public function setDayAttribute($value){
        return $this->attributes['day'] = date("Y-m-d", strtotime($value));
    }
    
    /**
     * Acessor of day value
     * 
     * @return String
     */
    public function getPriceAttribute($value){
        $number_formated = number_format($value,2,',','.');
        return "R$ $number_formated";
    } 

    /**
     * Acessor of day value
     * 
     * @return String
     */
    public function getDayAttribute($value){
        return date("d/m/Y", strtotime($value));
    } 
}
