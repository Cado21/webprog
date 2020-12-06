<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $fillable = [
        'quantity',
        'price'
    ];
    
    public function product(){
        return $this->belongsTo('App\Product');
    }
    public function transaction() {
        return $this->belongsTo('App\Transaction');
    }
}
