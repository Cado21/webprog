<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'quantity', 
        'checkout',
    ];
    
    // default value
    protected $attributes = [
        'checkout' => false,
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function product(){
        return $this->belongsTo('App\Product');
    }
    public function transaction() {
        return $this->belongsTo('App\Transaction');
    }
}
