<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

Route::get('/', function(){
    return redirect(url('book'));
});

Route::group(['middleware' => 'auth'], function () {
    // categories routes
    Route::delete('/category/delete/{id}', 'CategoryController@delete');
    Route::get('/category/{id}', ['as' => 'category-edit', 'uses' => 'CategoryController@index']);
    Route::post('/category/{id?}', 'CategoryController@index');
    Route::get('/category', ['as' => 'category', 'uses' => 'CategoryController@index']);

    // writers route
    Route::delete('/writer/delete/{id}', 'WriterController@delete');
    Route::get('/writer/detail/{id}', 'WriterController@detail');
    Route::get('/writer/{id}', ['as' => 'writer-edit', 'uses' => 'WriterController@index']);
    Route::post('/writer/{id?}', 'WriterController@index');
    Route::get('/writer', ['as' => 'writer', 'uses' => 'WriterController@index']);

    // publishers route
    Route::delete('/publisher/delete/{id}', 'PublisherController@delete');
    Route::get('/publisher/detail/{id}', 'PublisherController@detail');
    Route::get('/publisher/{id}', ['as' => 'publisher-edit', 'uses' => 'PublisherController@index']);
    Route::post('/publisher/{id?}', 'PublisherController@index');
    Route::get('/publisher', ['as' => 'publisher', 'uses' => 'PublisherController@index']);

    // books route
    Route::delete('/book/delete/{id}', 'BookController@delete');
    Route::post('/book/remote/{type}', 'BookController@remote');
    Route::post('/book/save', 'BookController@form');
    Route::get('/book/add', 'BookController@form');
    Route::get('/book/edit/{id}', 'BookController@form');
    Route::get('/book/detail/{id}', 'BookController@detail');
    Route::get('/book', ['as' => 'book', 'uses' => 'BookController@index']);
});