<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Easyload extends Model
{
   public function customer(){
       return $this->belongsTo("App\Customer");
   }
}
