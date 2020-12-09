<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $fillable = [
        'quantity',
        'price',
        'name', 
        'image',
        'description',
        'product_id',
        'type_id',
        'type_name',
    ];
    
    public function transaction() {
        return $this->belongsTo('App\Transaction');
    }
}
