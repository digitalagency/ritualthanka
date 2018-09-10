<?php

Route::group(
    [
        'prefix' => 'product/',
        'as'     =>  'product.',
    ],
    function () {
        Route::group(['namespace' => 'Post'],function(){
            //product category
            Route::get('category','PostController@category')->name('category');
            Route::get('category/{id}','PostController@category')->name('category');
            Route::post('store-category','PostController@catstore')->name('catstore');
            Route::delete('category/{category}', 'PostController@catdestroy')->name('catdestroy');

            //product
            Route::get('','PostController@prodIndex')->name('prodIndex');
            Route::get('/create','PostController@prodCreate')->name('prodCreate');
            Route::post('/store','PostController@storeProduct')->name('storeProduct');
            Route::get('edit/{id}','PostController@editProduct')->name('editProduct');
            Route::delete('{id}','PostController@deleteProduct')->name('deleteProduct');

            //Stock
            Route::get('stock/{id}','PostController@listStock')->name('listStock');
            Route::post('stockstore','PostController@stockstore')->name('stockstore');

            //get product according to category id
            Route::post('getcatproducts','PostController@getcatproducts')->name('getcatproducts');
        });

    });

Route::group(
    [
        'prefix' => 'exchange/',
        'as'     =>  'exchange.',
    ],
    function () {
        Route::group(['namespace' => 'Post'],function(){
            //product category
            Route::get('','PostController@exchange')->name('exchange');
            Route::get('/{id}','PostController@exchange')->name('exchange');
            Route::post('store-rate','PostController@ratestore')->name('ratestore');
        });

    });

/*Route::group(
    [
        'prefix'    => 'post/',
        'as'        =>  'post.',
    ],
    function(){
        Route::group(['namespace' => 'Post'],function(){
            //Post category
            Route::get('category','PostController@postcat')->name('postcat');
            Route::get('category/{id}','PostController@postcat')->name('postcat');
            Route::post('store-category','PostController@postcatstore')->name('postcatstore');
            Route::delete('category/{category}', 'PostController@postcatdestroy')->name('postcatdestroy');
            //Post
            Route::get('','PostController@postIndex')->name('postIndex');
            Route::get('/create','PostController@postCreate')->name('postCreate');
            Route::post('/store','PostController@storePost')->name('storePost');
            Route::get('edit/{id}','PostController@editPost')->name('editPost');
            Route::delete('{id}','PostController@deletePost')->name('deletePost');
        });
    });*/

Route::group(
    [
        'prefix'    => 'banner/',
        'as'        =>  'banner.',
    ],
    function(){
        Route::group(['namespace' => 'Post'],function(){
            //Post category
            Route::get('category','PostController@bannercat')->name('bannercat');
            Route::get('category/{id}','PostController@bannercat')->name('bannercat');
            Route::post('store-category','PostController@bannercatstore')->name('bannercatstore');
            Route::delete('category/{category}', 'PostController@bannercatdestroy')->name('bannercatdestroy');
            //Post
            Route::get('','PostController@bannerIndex')->name('bannerIndex');
            Route::get('/create','PostController@bannerCreate')->name('bannerCreate');
            Route::post('/store','PostController@storeBanner')->name('storeBanner');
            Route::get('edit/{id}','PostController@editBanner')->name('editBanner');
            Route::delete('{id}','PostController@deleteBanner')->name('deleteBanner');
        });
    });


Route::group(
    [
        'prefix'    => 'brocade/',
        'as'        =>  'brocade.',
    ],
    function(){
        Route::group(['namespace' => 'Post'],function(){
            //Post category
            Route::get('category','PostController@brocadecat')->name('brocadecat');
            Route::get('category/{id}','PostController@brocadecat')->name('brocadecat');
            Route::post('store-category','PostController@brocadecatstore')->name('brocadecatstore');
            Route::delete('category/{category}', 'PostController@brocadecatdestroy')->name('brocadecatdestroy');
            //Post
            Route::get('','PostController@brocadeIndex')->name('brocadeIndex');
            Route::get('/create','PostController@brocadeCreate')->name('brocadeCreate');
            Route::post('/store','PostController@storeBrocade')->name('storeBrocade');
            Route::get('edit/{id}','PostController@editBrocade')->name('editBrocade');
            Route::delete('{id}','PostController@deleteBrocade')->name('deleteBrocade');
        });
    });


Route::group(
    [
        'prefix'    => 'handle/',
        'as'        =>  'handle.',
    ],
    function(){
        Route::group(['namespace' => 'Post'],function(){

            //Post
            Route::get('','PostController@handleIndex')->name('handleIndex');
            Route::get('/create','PostController@handleCreate')->name('handleCreate');
            Route::post('/store','PostController@storeHandle')->name('storeHandle');
            Route::get('edit/{id}','PostController@editHandle')->name('editHandle');
            Route::delete('{id}','PostController@deleteHandle')->name('deleteHandle');
        });
    });


Route::group(
    [
        'prefix'    => 'news-events/',
        'as'        =>  'news-events.',
    ],
    function(){
        Route::group(['namespace' => 'Post'],function(){

            //Post
            Route::get('','PostController@newsIndex')->name('newsIndex');
            Route::get('/create','PostController@newsCreate')->name('newsCreate');
            Route::post('/store','PostController@storeNews')->name('storeNews');
            Route::get('edit/{id}','PostController@editNews')->name('editNews');
            Route::delete('{id}','PostController@deleteNews')->name('deleteNews');
        });
    });

Route::group(
    [
        'prefix'    => 'buyers/',
        'as'        =>  'buyers.',
    ],
    function(){
        Route::group(['namespace' => 'Post'],function(){

            //Post
            Route::get('','PostController@buyerIndex')->name('buyerIndex');
            Route::get('/{id}','PostController@buyerIndex')->name('buyerIndex');
            Route::post('store','PostController@disstore')->name('disstore');
        });
    });


Route::group(
    [
        'prefix'    => 'orders/',
        'as'        =>  'orders.',
    ],
    function(){
        Route::group(['namespace' => 'Post'],function(){

            //Post
            Route::get('','PostController@ordersIndex')->name('ordersIndex');
            Route::get('/{id}','PostController@ordersIndex')->name('ordersIndex');
            Route::post('/edit','PostController@ordersedit')->name('ordersedit');
            Route::get('/byuser/{id}','PostController@ordersByuser')->name('ordersByuser');
            //Route::post('store','PostController@disstore')->name('disstore');
        });
    });