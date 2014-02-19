<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::controller('users', 'UsersController');

// Route::controller('message', 'MessageController');

Route::post( '/message/send', array(
    'as' => 'message',
    'uses' => 'MessageController@save'
) );

Route::get( '/message/latest', array(
    'as' => 'message',
    'uses' => 'MessageController@latest_msg'
) );

Route::post( '/message/save', array(
    'as' => 'message',
    'uses' => 'MessageController@save_user_message'
) );

Route::get( '/message/getsaved', array(
    'as' => 'message',
    'uses' => 'MessageController@get_saved_user_mesages'
) );



