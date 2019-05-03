<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//make mandatory login first before perform such actions
Route::middleware('auth')->group( function() {  //create a group to apply middleware rules

    Route::get('/', 'ContentsController@home')->name('home');     // execute class controller name @ method name
    Route::get('/clients', 'ClientController@index')->name('clients');  // execute class controller name @ method name
    Route::get('/clients/new', 'ClientController@newClient')->name('new_client');     // execute class controller name @ method name
    Route::post('/clients/new', 'ClientController@newClient')->name('create_client');     //to process a form with method POST
    Route::get('/clients/{client_id}', 'ClientController@show')->name('show_client');     // send parameters to the method
    Route::post('/clients/{client_id}', 'ClientController@modify')->name('update_client');    // send parameters to the method to update, since it's a post

    Route::get('/reservations/{client_id}', 'RoomsController@checkAvailableRooms')->name('check_room');     // check reservations
    Route::post('/reservations/{client_id}', 'RoomsController@checkAvailableRooms')->name('check_room');     // process reservations

    Route::get('/book/room/{client_id}/{room_id}/{date_in}/{date_out}', 'ReservationsController@bookRoom')->name('book_room');     // send multiple parameters to the method

    Route::get('export','ClientController@export');     // execute class controller name @ method name

    Route::get('/upload', 'ContentsController@upload')->name('upload');     // execute class controller name @ method name
    Route::post('/upload', 'ContentsController@upload')->name('upload');     // //to process a form with method POST

});     // end of  group to apply middleware rules

/* Route::get('/', function () {
    //return view('welcome');
    return '<h3>Landon App Page</h3>';
});
 */

Route::get('/about', function () {
    return '<h3>About</h3>';
});

Route::get('/array', function () {
    $response_array=[];
    $response_array['author'] = 'bp';
    $response_array['version'] = '0.1.1';
    return $response_array;                 //laravel will convert it into JSON array
});

Route::get('/home', function () {
    $data = [];
    $data['version']='0.1.1';
    return view('welcome',$data);             // return a view with some data
});


Route::get('/di', 'ClientController@di');       //class class <controller>@<Method>

Route::get('/facades/db', function () {
    return DB::select('select * from table');       //route for facades
});

Route::get('/facades/encrypt', function () {
    return Crypt::encrypt('123456789');       //route for encrypt
});

//eyJpdiI6InFiUkM3Zm9keWRMcmZ4eVwvUzJ5dXlRPT0iLCJ2YWx1ZSI6IkVzRWk2eUh3NlFWYXhxZUpGbUlXVm9NQ2lYZ01URmpuRWVCdVcyOFVJcDQ9IiwibWFjIjoiYmUyNzkxZDEzYTM1NGUzMmJhMmEwZDQ0MzFiMGFmOWUxMzU2MjU1NGE2OTE5ZThjOTg1YTE5ZmMxOTVmNzkzZiJ9
Route::get('/facades/decrypt', function () {
    return Crypt::decrypt('eyJpdiI6InFiUkM3Zm9keWRMcmZ4eVwvUzJ5dXlRPT0iLCJ2YWx1ZSI6IkVzRWk2eUh3NlFWYXhxZUpGbUlXVm9NQ2lYZ01URmpuRWVCdVcyOFVJcDQ9IiwibWFjIjoiYmUyNzkxZDEzYTM1NGUzMmJhMmEwZDQ0MzFiMGFmOWUxMzU2MjU1NGE2OTE5ZThjOTg1YTE5ZmMxOTVmNzkzZiJ9');       //route for encrypt
});

//routes to login methods
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//generate a random hashed password
Route::get('generate/password', function(){
    return bcrypt('123456789');     
});
