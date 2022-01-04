<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::middleware('auth')->group(function () {
    Route::get('/management', 'HomeController@management');
    Route::get('/barangays/{id}', 'HomeController@barangays'); 
});

Route::middleware('auth')->group(function () {
    Route::get('/lists', 'DropdownController@page'); 
    Route::get('/positions', 'PositionController@page');
    Route::get('/groups', 'GroupController@page'); 
    Route::get('/vehicles', 'VehicleController@page'); 
    Route::get('/employees', 'UserController@page');
    Route::get('/roles', 'RoleController@page');
    Route::get('/documents/incoming', 'Modules\Trace\DocumentController@pageIn');
    Route::get('/documents/outgoing', 'Modules\Trace\DocumentController@pageOut');
});

//###########==========! REQUEST ROUTES !=========###########//

Route::prefix('request')->group(function () {

    Route::get('/counts', 'Employee\HomeController@counts');

    Route::get('/dropdown/{classification}/{type}/{keyword}', 'DropdownController@index');
    Route::get('/dropdowns/{classification}/{type}', 'DropdownController@lists');
    Route::get('/dropdowncount/{classification}/{type}', 'DropdownController@count');
    Route::post('/dropdown/store', 'DropdownController@store');

    Route::prefix('common')->group(function(){
        Route::post('/listing/search', 'ListingController@search');
        Route::post('/listing/store', 'ListingController@store');
    });



    
    Route::prefix('admin')->group(function(){
        Route::get('/positions', 'PositionController@lists');
        Route::get('/positions/{keyword}', 'PositionController@index');
        Route::post('/position/store', 'PositionController@store');
        Route::post('/position/search', 'PositionController@search');

        Route::get('/groups', 'GroupController@lists');
        Route::get('/groups/{keyword}', 'GroupController@index');
        Route::post('/group/store', 'GroupController@store');
        Route::post('/group/search', 'GroupController@search');

        Route::get('/roles', 'RoleController@lists');
        Route::get('/roles/{keyword}', 'RoleController@index');
        Route::post('/role/store', 'RoleController@store');
        Route::post('/role/search', 'RoleController@search');

        Route::get('/vehicles', 'VehicleController@lists');
        Route::get('/vehicles/{keyword}', 'VehicleController@index');
        Route::post('/vehicle/store', 'VehicleController@store');
        Route::post('/vehicle/search', 'VehicleController@search');

        Route::get('/employees/lists/{keyword}', 'UserController@lists');
        Route::get('/employees/{keyword}', 'UserController@index');
        Route::post('/employee/search', 'UserController@search');
        Route::post('/employee/store', 'UserController@store');
        Route::post('/employee/role', 'UserController@roles');
        Route::post('/employee/group', 'UserController@groups');
    });




    Route::prefix('employee')->group(function(){
        Route::get('/notification/document/seen', 'Modules\Trace\NotificationController@seen');
        Route::get('/notification/travel/seen', 'Modules\Travel\NotificationController@seen');
        Route::get('/documents/my/{type}/{completed}/{keyword}/{count}', 'Employee\DocumentController@index');
    });

    Route::prefix('management')->group(function(){
        Route::get('/notification/trace/seen', 'Modules\Trace\NotificationController@seen');
        Route::get('/documents/{types}/{type}/{completed}/{keyword}', 'Employee\DocumentController@index');
    });


    Route::post('/travel/store', 'Modules\Travel\TravelController@store');
    Route::get('/travel/lists', 'Modules\Travel\TravelController@lists');
    Route::get('/travels/{type}/{status}/{mode}/{keyword}/{page}', 'Modules\Travel\TravelController@index');
    Route::get('/travels/admin/{type}/{status}/{mode}/{keyword}/{page}', 'Modules\Travel\TravelController@admin');
    Route::get('/travel/{id}', 'Modules\Travel\TravelController@view');
    Route::post('/travel/status', 'Modules\Travel\TravelController@status');
    Route::post('/travel/comment', 'Modules\Travel\CommentController@store');
    Route::get('/travel/view/{id}/{type}', 'Modules\Travel\NotificationController@viewed');

    Route::get('/documents/{doctype}/{type}/{status}/{completed}/{keyword}/{counts}', 'Modules\Trace\DocumentController@index');
    Route::post('/document/store', 'Modules\Trace\DocumentController@store');
    Route::post('/document/route', 'Modules\Trace\DocumentController@route');
    Route::post('/document/comment', 'Modules\Trace\CommentController@store');
    Route::post('/document/download', 'Modules\Trace\DocumentController@download');
    Route::get('/document/{id}', 'Modules\Trace\DocumentController@find');
    Route::get('/document/view/{id}', 'Modules\Trace\DocumentController@viewed');
});