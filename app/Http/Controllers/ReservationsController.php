<?php

namespace App\Http\Controllers;

use App\Client as Client;
use App\Room as Room;
use App\Reservation as Reservation;

use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    //
    public function bookRoom($client_id, $room_id, $date_in, $date_out)
    {
        //return __METHOD__ ;

        $reservation = new Reservation();
        $client_instance = new Client();
        $room_instance = new Room();

        $client  = $client_instance->find($client_id);  //search in db for the client with this ID
        $room = $room_instance->find($room_id);         //search in DB for the room with that ID
        $reservation->date_in = $date_in;
        $reservation->date_out = $date_out;

        $reservation->room()->associate($room);         //associate the reservation with the room, using the FK
        $reservation->client()->associate($client);     //associate the reservation with the client, using the FK

        if( $room_instance->isRoomBooked($room_id, $date_in, $date_out))
        {
            abort(405, 'Trying to book an already booked room');
        }else
        {
            $reservation->save();                           //perform update into DB
        }
        

        return redirect()->route('clients');          //redirect

        //return view('reservations/bookRoom');
    }
}
