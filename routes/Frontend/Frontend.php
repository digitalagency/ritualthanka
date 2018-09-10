<?php

/**
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', 'FrontendController@index')->name('index');
Route::get('macros', 'FrontendController@macros')->name('macros');
Route::get('contact', 'ContactController@index')->name('contact');
Route::post('contact/send', 'ContactController@send')->name('contact.send');

Route::get('about-us', 'FrontendController@about')->name('about');

Route::get('category','ProductController@category')->name('category');
Route::get('category/{slug}','ProductController@category')->name('category');

Route::get('product/{slug}', 'ProductController@product')->name('product');

Route::get('news-events/{slug}', 'FrontendController@newsevents')->name('newsevents');
/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 */
Route::group(['middleware' => 'auth'], function () {
    Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
        /*
         * User Dashboard Specific
         */
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        /*
         * User Account Specific
         */
        Route::get('account', 'AccountController@index')->name('account');

        /*
         * User Profile Specific
         */
        Route::patch('profile/update', 'ProfileController@update')->name('profile.update');
    });
});

Route::post('add-to-cart','ProductController@addtocart')->name('addtocart');
Route::get('view-cart','ProductController@viewCart')->name('viewCart');

Route::group(['middleware'=>'auth'],function(){
    Route::get('checkout','ProductController@checkout')->name('checkout');
    Route::post('checkout','ProductController@storecheckout')->name('storecheckout');
    Route::get('orders','ProductController@orders')->name('orders');
});

Route::post('brocadehandle','ProductController@brocadehandle')->name('brocadehandle');

Route::get('remove/{id}','ProductController@getRemoveItem')->name('getRemoveItem');

Route::get('featured-thangkas','ProductController@featuredProduct')->name('featuredProduct');
Route::get('popular-thangkas','ProductController@popularProduct')->name('popularProduct');
Route::get('old-thangkas','ProductController@oldProduct')->name('oldProduct');
Route::get('on-slae','ProductController@saleProduct')->name('saleProduct');