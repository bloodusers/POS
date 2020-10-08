<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use function App\Http\Controllers\getFeild;

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
Route::get('/tmp',function ()
{
    return App\Category::with('children')->whereNull('category_id')->get();
});
Route::get('/chk',function ()
{
    dd(getFeild('id','categories','organization_id ='.Auth::user()->organization_id ));
   // return view('tempPage');
});
Route::get('/sChk',function ()
{
    return view('invoice.Search');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//admin
Route::get('/adminPage', 'AdminController@index')->name('adminPage');
//Route::post('/changeStatus/{user}', 'AdminController@update')->name('/changeStatus/{id}');
//org
Route::post('/org/{user}/changeStatus', 'OrganizationController@toggleStatus')->name('/org/{user}/changeStatus');
Route::post('/org/{user}/edit', 'OrganizationController@edit')->name('/org/{user}/edit');//edit form
Route::patch('/org/{user}', 'OrganizationController@update')->name('/org.update');//update from controller
Route::get('/addOrg', 'OrganizationController@index')->name('addOrg');
Route::post('/registerOrg', 'OrganizationController@create')->name('/registerOrg');
//end org category
Route::get('/addCategory', 'CategoryController@index')->name('addCategory');
Route::get('/editCategory', 'CategoryController@editList')->name('category.edit');//show listing
Route::post('/Cat/{id}/edit', 'CategoryController@edit')->name('/cat/{id}/edit');//edit form
Route::delete('/Cat/{id}/delete', 'CategoryController@delete')->name('Category.destroy');//delete category
Route::patch('/Cat/{id}', 'CategoryController@update')->name('/Cat.update');//update from controller
Route::get('/showCategory', 'CategoryController@view')->name('showCategory');
Route::post('/regCategory', 'CategoryController@create')->name('/regCategory');
//end category
//item
Route::get('/addItem', 'ItemController@index')->name('item.add');
Route::post('/regItem', 'ItemController@create')->name('item.register');
Route::get('/editItem', 'ItemController@editList')->name('editItem');//show listing
Route::post('/item/{id}/edit', 'ItemController@edit')->name('item.edit');//edit form
Route::patch('/item/{id}', 'ItemController@update')->name('Cat.update');//update from edit
Route::delete('/item/{id}/delete', 'ItemController@delete')->name('item.destroy');//delete category
//end Item
//invoice
//Route::get('/invoice','SearchController@invoice');
Route::get('/search', 'SearchController@search')->name('search.search');
Route::get('/getItem/{id}', 'SearchController@getItemWithId')->name('invoice.item');
Route::get('/invoice', 'InvoiceController@index')->name('invoice.index');
Route::get('/invoice/{id}/receipt', 'InvoiceController@receipt')->name('invoice.receipt');//receipt
Route::post('/addInvoice', 'InvoiceController@create')->name('invoice.add');
Route::post('/addInvoiceItem', 'InvoiceItemController@create')->name('invoiceItem.add');
//invoice end
//return
Route::get('/return', 'ReturnController@index')->name('return.index');
Route::get('/invoice/{id}/find', 'InvoiceController@find')->name('invoice.find');//receipt
Route::get('/invoiceItems/{id}', 'InvoiceItemController@getItems')->name('invoiceItems.get');//receipt
Route::post('/returnInvoice', 'ReturnController@create')->name('return.add');
Route::post('/returnInvoiceItems', 'ReturnItemController@create')->name('returnItem.add');


//endReturn
Route::post('/registerUser', 'Auth\RegisterController@create')->name('/registerUser');

