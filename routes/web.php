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

    Route::get('/admin', 'Admin\AdminController@index');

    Auth::routes();

    /*admin*/

    Route::middleware(['auth'])->group(function() {
        Route::group(['namespace' => 'Admin'], function() {

            Route::group(['prefix' => '/admin/menu-item'], function() {
                Route::get('/', 'MenusController@listData')->name('admin.menu.listData');
                Route::get('/add', 'MenusController@detailCate')->name('admin.menu.getAddCate');
                Route::post('/task', 'MenusController@task')->name('admin.menu.task');

                Route::get('/add/{id}', 'MenusController@editCate')->name('admin.menu.getEditCate')->where('id', '[0-9]+');
            });

            Route::group(['prefix' => '/admin/cate-food'], function() {
                Route::get('/', 'CateFoodsController@listData')->name('admin.cateFood.listData');
                Route::get('/add', 'CateFoodsController@detail')->name('admin.cateFood.getAddCate');
                Route::post('/task', 'CateFoodsController@task')->name('admin.cateFood.task');

                Route::get('/add/{id}', 'CateFoodsController@editR')->name('admin.cateFood.getEditCate')->where('id', '[0-9]+');
            });

            Route::group(['prefix' => '/admin/food'], function() {
                Route::get('/', 'FoodsController@listData')->name('admin.food.listData');
                Route::get('/add', 'FoodsController@detail')->name('admin.food.getAddCate');
                Route::post('/task', 'FoodsController@task')->name('admin.food.task');

                Route::get('/add/{id}', 'FoodsController@editR')->name('admin.food.getEditCate')->where('id', '[0-9]+');
            });

            Route::group(['prefix' => 'admin/order'], function() {
                Route::get('/', 'BooksController@listData')->name('admin.order.listData');
                Route::post('/task', 'BooksController@task')->name('admin.order.task');

                Route::get('/add/{id}', 'BooksController@editR')->name('admin.order.getEditCate')->where('id', '[0-9]+');
            });
        });
    });


    Route::get('book', 'Admin\BooksController@order')->name('book');



    Route::get('/admin/image','MultiImagesController@getUpload');
    Route::post('/admin/upload', 'MultiImagesController@postUpload');
    Route::delete('/admin/upload-delete','MultiImagesController@deleteUpload');


    Route::post('/image', 'ImageController@size')->name('admin.images');


    Route::get('/image', function() {
        return view('admin.image');
    });


    /*code*/
    Route::get('/', 'HomeController@show')->name('/');
