<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = [ "created_at" ]; // enable only to created_at

    public function cart(){
      return $this->hasMany('App\Cart');
    }
}
