<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'quantity', 
        'price',
        'checkout',
    ];
    public function User(){
        return $this->hasOne('App\User');
    }
    public function Product(){
        return $this->hasOne('App\Product');
    }
}
