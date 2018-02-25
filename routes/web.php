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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', ['uses' => 'DashboardController@index']);

Route::get('/users', ['uses' => 'DashboardController@allUsers']);
Route::get('/user/{id?}/delete', ['uses' => 'DashboardController@deleteUser']);
Route::get('/user/{id?}/edit', ['uses' => 'DashboardController@editUser']);
Route::post('//user/{id?}/edit', ['uses' => 'DashboardController@editUserPost']);

Route::get('/account', ['uses' => 'DashboardController@myAccount']);
Route::post('/account', ['uses' => 'DashboardController@myAccountPost']);

Route::get('/my-reports', ['uses' => 'DashboardController@myReports']);
Route::get('/report/add', ['uses' => 'DashboardController@addReport']);
Route::post('/report/add', ['uses' => 'DashboardController@addReportPost']);
Route::get('/report/{id?}/edit', ['uses' => 'DashboardController@addReport']);
Route::get('/reports', ['uses' => 'DashboardController@userReports']);
Route::get('/reports/{id?}', ['uses' => 'DashboardController@reports']);

Route::get('/login', array('as' => 'login','uses' => 'HomeController@login'));
Route::post('/login', ['uses' => 'Auth\LoginController@login']);
Route::get('/logout', ['uses' => 'Auth\LoginController@logout']);
Route::get('/register', ['uses' => 'HomeController@login']);
Route::post('/register', ['uses' => 'Auth\RegisterController@create']);


