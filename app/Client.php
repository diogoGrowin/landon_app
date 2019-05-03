<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //

    public function reservations()
    {   
        //define the relationship type between Client and Reservation
        return $this->hasMany('App\Reservation');  
    }
}
