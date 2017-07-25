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

Route::get('/',[
  'uses' => 'PagesController@getLoginPage',
  'as' => 'welcome'
]);

Route::group(['middleware'=>'auth'],function(){

  Route::get('/home',[
    'uses' => 'PagesController@getHome',
    'as' => 'home'
  ]);

  Route::get('sales',[
    'uses' => 'PagesController@getSalesRegisterPage',
    'as' => 'sales-register-page'
  ]);

  Route::post('sales',[
    'uses' => 'SalesController@addToCart',
    'as' => 'addToCart'
  ]);

  Route::get('sales/all',[
    'uses' => 'SalesController@getSalesPage',
    'as' => 'sales-page'
  ]);

  Route::get('sales/sold',[
    'uses' => 'SalesController@getSoldPage',
    'as' => 'sales-sold'
  ]);

  Route::post('sales/qty/{product_id}',[
    'uses' => 'SalesController@updateQty',
    'as' => 'update-qty'
  ]);

  Route::post('sales/disc/{product_id}',[
    'uses' => 'SalesController@updateDiscount',
    'as' => 'update-disc'
  ]);

  Route::post('sales/delete/{item_id}',[
    'uses' => 'SalesController@deleteItemFromCart',
    'as' => 'delete-item'
  ]);

  Route::post('sales/register',[
    'uses'=>'SalesController@registerSale',
    'as'=>'sale-register'
  ]);

  Route::get('sale/{sale_id}',[
    'uses'=>'SalesController@getSingle',
    'as'=>'sale-single'
  ]);

  Route::get('search',[
    'uses' => 'SalesController@search',
    'as' => 'search'
  ]);

  Route::get('/products',[
    'uses' => 'ProductController@getProductsIndex',
    'as' => 'product-index'
  ]);

  Route::post('/products/register',[
    'uses' => 'ProductController@insertProduct',
    'as' => 'product-store'
  ]);

  Route::post('products/delete/{product_id}',[
    'uses'=>'ProductController@deleteProduct',
    'as' => 'product-delete'
  ]);
});

Auth::routes();
Route::get('logout','Auth\LoginController@logout')->name('logout');
