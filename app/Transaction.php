<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function User(){
        return $this->hasOne('App\User');
    }
    public function Product(){
        return $this->hasOne('App\Product');
    }
    public function Cart(){
        return $this->hasOne('App\Cart');
    }
}
