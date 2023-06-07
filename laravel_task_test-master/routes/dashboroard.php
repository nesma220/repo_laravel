<?php

use Illuminate\Support\Facades\Route;

//midelWare

Route::group(['middleware'=>['admin']],function(){
    Route::get('addPost/posts/create', 'PostController@create');
    Route::post('addPost/posts/store', 'PostController@store');
    Route::delete('addPost/posts/{id}', 'PostController@delete')->name('posts.destroy');
    Route::get('addPost/posts/{id}', 'PostController@edit')->name('posts.edit');
    Route::put('addPost/posts/update/{id}', 'PostController@update')->name('posts.update');
    Route::get('index', 'CategoryController@index');
    Route::get('test/', 'PostController@index');
});


//Route::get('index', 'CategoryController@index');


Route::get('/user', function () {
    return view('user_index');
});

