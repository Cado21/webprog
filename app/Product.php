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
    ];
    public function Type(){
        return $this->belongsTo('App\Type');
    }
}
