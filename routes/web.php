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

//Route::post( '/', function () {
//
//
//	return Alexa::say("Why was the little boy crying? Because he had a frog stapled to his face!");
//
//
//
//
//
//	return view( 'welcome', compact( 'text' ) );
//} );

Route::get( '/tasks/{id}', function ( $id ) {

	$tasks = DB::table( 'tasks' )->find( $id );

	return view( 'tasks.show', compact( 'tasks' ) );
} );

Route::get( '/tasks', function () {



	$tasks = DB::table( 'tasks' )->get();

	return view( 'tasks.show', compact( 'tasks' ) );
} );

Route::get( '/alexa-end-point', 'App\Http\Controllers\Controller@hello' );
Route::post( '/alexa-end-point', 'App\Http\Controllers\Controller@hello' );


//AlexaRoute::launch('/', 'hello', function(){
//	Alexa::say("Why was the little boy crying? Because he had a frog stapled to his face!");
//});
//
//AlexaRoute::intent('/alexa-end-point', 'GetHelpIntent', function(){
//	return Alexa::say("Oh hi Denny");
//
//});



//AlexaRoute::launch( '/alexa-end-point', 'App\Http\Controllers\Controller@hello' );

