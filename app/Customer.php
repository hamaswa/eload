<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    public function customersload(){
        return $this->hasMany('\App\Easyload');
    }

}
