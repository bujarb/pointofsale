<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public $timestamps = [ "created_at" ]; // enable only to created_at

    public function user(){
      return $this->belongsTo('App\User');
    }
}
