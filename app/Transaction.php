<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
    ];
    
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function details(){
        return $this->hasMany('App\TransactionDetail');
    }
}
