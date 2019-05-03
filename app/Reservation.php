<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    //
    public function client()
    {   
        //define the relationship type between Reservation and Client
        return $this->belongsTo('App\Client','client_id','id'); 
    }

    public function room()
    {
        return $this->belongsTo('App\Room', 'room_id','id'); //room_id field in table reservation is a FK to field id in table room
    }
}
