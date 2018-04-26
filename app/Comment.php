<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  public $table = 'comments';
  public function product(){
      return $this->belongsTo('App\Product');
  }
  public function customer(){
      return $this->belongsTo('App\Customer');
  }
}
