<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
  public function genre()
  {
      return $this->belongsTo('App\Genre');
  }
}
