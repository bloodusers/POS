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
})->name('welcome');

//Route::view('/registerorg', 'registerorg');
//Route::post('/regOrg/submit', 'OrganizationController@store')->name('/regOrg/submit');
//Route::get('/regOrg/create', 'OrganizationController@create')->name('');
//Route::post('companyStore', 'OrganizationController@store')->name('companyStore');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//admin
Route::get('/adminPage', 'AdminController@index')->name('adminPage');
Route::post('/changeStatus/{user}', 'AdminController@update')->name('/changeStatus/{id}');
//org
Route::get('/addOrg', 'OrganizationController@index')->name('addOrg');
Route::post('/registerOrg', 'OrganizationController@create')->name('/registerOrg');
//end org category
Route::get('/addCategory', 'CategoryController@index')->name('addCategory');
Route::get('/showCategory', 'CategoryController@view')->name('showCategory');
Route::post('/regCategory', 'CategoryController@create')->name('/regCategory');
//end category
Route::post('/registerUser', 'Auth\RegisterController@create')->name('/registerUser');

