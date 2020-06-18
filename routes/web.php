<?php

use App\State;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function() {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('states', 'StatesController');

    Route::get('/clients/search', 'Search\SearchClientsController@index')->name('clients.searchClients');
    Route::resource('clients', 'ClientsController');
  
    Route::get('/users/search','Search\SearchUsersController@index')->name('users.searchUsers');
    Route::resource('users', 'UserController');

    Route::resource('comments', 'CommentController');

    Route::get('/tickets/search','Search\SearchTicketsController@index')->name('tickets.searchTickets');
    Route::resource('tickets', 'TicketsController');

    Route::get('notifications', 'UserNotificationsController@show')->name('notifications.show');
});