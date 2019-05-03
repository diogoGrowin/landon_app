<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()                //the fields of the table
    {
        Schema::create('reservations', function (Blueprint $table) {
            //$table->engine = 'InnoDB';
            $table->increments('id');
            $table->date('date_in');
            $table->date('date_out');

            /*** foreign key field creation ***/

            $table->integer('client_id')->unsigned();     
            $table->foreign('client_id')->references('id')->on('clients');

            $table->integer('room_id')->unsigned();     
            $table->foreign('room_id')->references('id')->on('rooms');

            /*** end of foreign key field creation ***/

            $table->timestamps();
        });

/*         Schema::table('reservations', function(Blueprint $table) {
            // $table->foreign('user_id')->references('id')->on('users'); 
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('room_id')->references('id')->on('rooms');
        }); */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
