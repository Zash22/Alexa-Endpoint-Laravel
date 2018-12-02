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

Route::get( '/', function () {

	$text = "\"I'm here to chew gum and kick ass... and I'm all out of gum.\" - Riaan de Lange";




	return view( 'welcome', compact( 'text' ) );
} );

Route::get( '/tasks/{id}', function ( $id ) {

	$tasks = DB::table( 'tasks' )->find( $id );

	return view( 'tasks.show', compact( 'tasks' ) );
} );

Route::get( '/tasks', function () {



	$tasks = DB::table( 'tasks' )->get();

	return view( 'tasks.show', compact( 'tasks' ) );
} );
