<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class Category extends Model
{
    //Inserito Mass Assignement
    protected $guarded=[];

    //Relazioni tra Model
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_category');
    }
}
