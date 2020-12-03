<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 
        'stock',
        'price',
        'image',
        'description',
    ];
    public function type(){
        return $this->belongsTo('App\Type');
    }
    public function transactionDetail(){
        return $this->belongsTo('App\TransactionDetail');
    }
}