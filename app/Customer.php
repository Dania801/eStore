<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $table = 'customers';
    public function comments(){
        return $this->hasMany('App\Comment');
    }
    public function orders(){
      return $this->hasMany('App\Order');
    }
}
