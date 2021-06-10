<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plate extends Model
{
    //Inserito Mass Assignement - Eccezione Types 
    protected $guarded=['types'];

    //Relazioni tra Model
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Order', 'plate_order');
    }

    public function types()
    {
        return $this->belongsToMany('App\Type', 'plate_type');
    }
}
