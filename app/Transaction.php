<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'price', 
    ];
    
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function cart(){
        return $this->hasOne('App\Cart');
    }
}
