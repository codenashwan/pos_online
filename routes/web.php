<?php
use Illuminate\Support\Facades\Route;
Auth::routes([
    'register' => false,
    'verify' => false ,
    'reset' => false,
    'password.request' => false,
    'password.reset' =>false 
]);


Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');


// Cashier Page
Route::get("/cashier" , 'HomeController@Cashier')->name('Cashier');
Route::post('/cashier' ,  'HomeController@AddCashier')->name('AddCashier');

// Supplier Page
Route::get("/supplier" , 'HomeController@supplier')->name('supplier');
Route::post('/supplier/{status}/{id}' ,  'HomeController@AddSupplier')->name('supplier');


// Buy Page
Route::get("/buy" , 'HomeController@buy')->name('buy');
Route::post("/buy/{status}/{id}" , 'HomeController@add_stock')->name('add_stock');

// Not Left Page
Route::get("notleft" , 'HomeController@notleft')->name('notleft');


// Debt Page
Route::get("debtlist" , 'HomeController@debtlist')->name('debtlist');

// Expire Page
Route::get("expire" , 'HomeController@expire')->name('expire');


// Sellers Page
Route::get("sellers" , 'HomeController@sellers')->name('sellers');


// Sale Page
Route::get("sale" , 'HomeController@sale')->name('sale');
Route::post("sale" , 'HomeController@get_sale')->name('sale');
Route::post("viewtb" , 'HomeController@viewtb')->name('viewtb');
Route::post("undo" , 'HomeController@undo')->name('undo');
Route::post("invoice" , 'HomeController@invoice')->name('invoice');
Route::get("clean" , 'HomeController@clean')->name('clean');


