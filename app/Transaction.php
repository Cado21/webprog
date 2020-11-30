<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'price', 
    ];
    
    public function User(){
        return $this->hasOne('App\User');
    }
    public function Cart(){
        return $this->hasOne('App\Cart');
    }
}
