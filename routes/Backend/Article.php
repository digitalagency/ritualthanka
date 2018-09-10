<?php

Route::group([
    'prefix'    =>  'article',
    'as'        =>  'article.',
    //'namespace' =>  'Article',

],function(){
    Route::group(['namespace' => 'Article'],function(){
        Route::get('/', 'ArticleController@index')->name('index');
        Route::get('/create', 'ArticleController@create')->name('create');
        Route::get('/article/{article}', 'ArticleController@show')->name('show');
        Route::patch('/article/{article}', 'ArticleController@update')->name('update');
        Route::delete('/article/{article}', 'ArticleController@update')->name('delete');

        Route::resource('article' , 'ArticleController');
    });
});