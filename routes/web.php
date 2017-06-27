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

    /*Route::get('/', function () {
        return view('welcome');
    });*/

    Route::get('/admin', 'Admin\AdminController@index');

    Auth::routes();

    /*admin*/

    Route::middleware(['auth'])->group(function() {
        Route::group(['namespace' => 'Admin'], function() {
//        Route::group(['prefix' => '/admin/group-menu'], function() {
//            Route::get('/', 'GroupMenusController@listData')->name('admin.menuGroup.listData'); /*dạng danh sách*/
//            Route::get('/add', 'GroupMenusController@detail')->name('admin.menuGroup.getAddCate'); /*hiển thị trang thêm*/ /*dùng cho nút add*/
//            Route::post('/task', 'GroupMenusController@task')->name('admin.menuGroup.task'); /*lưu dữ liệu*/ /*dùng cho nút save & new, save, apply*/
//           /* Route::get('/task', function() {
//                return back()->withInput();
//            });*/
//
//            Route::get('/add/{id}', 'GroupMenusController@editR')->name('admin.menuGroup.getEditCate')->where('id', '[0-9]+'); /*cập nhật dữ liệu*/ /*dùng cho nút edit*/
//        });

            Route::group(['prefix' => '/admin/menu-item'], function() {
                Route::get('/', 'MenusController@listData')->name('admin.menu.listData'); /*dạng danh sách*/
                Route::get('/add', 'MenusController@detailCate')->name('admin.menu.getAddCate'); /*hiển thị trang thêm*/ /*dùng cho nút add*/
                Route::post('/task', 'MenusController@task')->name('admin.menu.task'); /*lưu dữ liệu*/ /*dùng cho nút save & new, save, apply*/
                /* Route::get('/task', function() {
                     return back()->withInput();
                 });*/

                Route::get('/add/{id}', 'MenusController@editCate')->name('admin.menu.getEditCate')->where('id', '[0-9]+'); /*cập nhật dữ liệu*/ /*dùng cho nút edit*/
            });

            Route::group(['prefix' => '/admin/cate-food'], function() {
                Route::get('/', 'CateFoodsController@listData')->name('admin.cateFood.listData'); /*dạng danh sách*/
                Route::get('/add', 'CateFoodsController@detail')->name('admin.cateFood.getAddCate'); /*hiển thị trang thêm*/ /*dùng cho nút add*/
                Route::post('/task', 'CateFoodsController@task')->name('admin.cateFood.task'); /*lưu dữ liệu*/ /*dùng cho nút save & new, save, apply*/
                /* Route::get('/task', function() {
                     return back()->withInput();
                 });*/

                Route::get('/add/{id}', 'CateFoodsController@editR')->name('admin.cateFood.getEditCate')->where('id', '[0-9]+'); /*cập nhật dữ liệu*/ /*dùng cho nút edit*/
            });

            Route::group(['prefix' => '/admin/food'], function() {
                Route::get('/', 'FoodsController@listData')->name('admin.food.listData'); /*dạng danh sách*/
                Route::get('/add', 'FoodsController@detail')->name('admin.food.getAddCate'); /*hiển thị trang thêm*/ /*dùng cho nút add*/
                Route::post('/task', 'FoodsController@task')->name('admin.food.task'); /*lưu dữ liệu*/ /*dùng cho nút save & new, save, apply*/
                /* Route::get('/task', function() {
                     return back()->withInput();
                 });*/

                Route::get('/add/{id}', 'FoodsController@editR')->name('admin.food.getEditCate')->where('id', '[0-9]+'); /*cập nhật dữ liệu*/ /*dùng cho nút edit*/
            });
            Route::get('admin/order', 'BookController@show')->name('admin.order');
            Route::post('admin/order', 'BookController@show');
        });
        /*Route::get('admin/logout', function() {
            Auth::logout();
        })->name('logout');*/
    });


    Route::get('book', 'Admin\BookController@order')->name('book');



    Route::get('/admin/image','MultiImagesController@getUpload');
    Route::post('/admin/upload', 'MultiImagesController@postUpload');
    Route::delete('/admin/upload-delete','MultiImagesController@deleteUpload');


    Route::post('/image', 'ImageController@size')->name('admin.images');


    Route::get('/image', function() {
        return view('admin.image');
    });

    //Route::post('/image', 'ImageResizeController@resizes')->name('admin.image');

    /*code*/
    Route::get('/', 'HomeController@show')->name('/');

//Route::get('/home', 'HomeController@index')->name('home');
