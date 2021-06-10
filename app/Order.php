<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
     //Inserito Mass Assignement
     protected $guarded=[];

     //Relazioni tra Model
     public function plates()
     {
        return $this->belongsToMany('App\Plate');
     }
 
}
