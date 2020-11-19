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
    public function Type(){
        return $this->belongsTo('App\Type');
    }
}
