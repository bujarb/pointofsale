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
  'middleware'=>'guest',
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

  Route::post('sale/delete/{id}',[
    'uses' => 'SalesController@deleteSale',
    'as' => 'sale-delete'
  ]);

  Route::get('sale/view/{sale_id}',[
    'uses' => 'SalesController@getSaleView',
    'as' => 'sale-view'
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

  Route::get('psearch',[
      'uses' => 'ProductController@search',
      'as' => 'psearch'
  ]);

  // Routes for products
  Route::group(['prefix'=>'products'],function(){
    Route::get('/',[
      'uses' => 'ProductController@getProductsIndex',
      'as' => 'product-index'
    ]);

    Route::post('register',[
      'uses' => 'ProductController@insertProduct',
      'as' => 'product-store'
    ]);

    Route::post('delete/{product_id}',[
      'uses'=>'ProductController@deleteProduct',
      'as' => 'product-delete'
    ]);
  });

  Route::group(['prefix'=>'reports'],function(){
      Route::get('daily',[
        'uses'=>'ReportsController@getDailyReport',
        'as'=>'report-daily'
      ]);

      Route::get('get/daily',[
        'uses'=>'ReportsController@dailyReportToPDF',
        'as'=>'daily-pdf-report'
      ]);

      Route::get('get/{sale_id}',[
        'uses'=>'ReportsController@getInvoiceForSale',
        'as'=>'invoice-for-sale'
      ]);

    Route::get('summary',[
        'uses'=>'ReportsController@getSummaryReportsIndex',
        'as'=>'report-summary'
      ]);

      Route::post('summary',[
        'uses'=>'ReportsController@generateSummaryReport',
        'as'=>'report-generate'
      ]);
  });

  Route::group(['prefix'=>'expenses'],function(){
    Route::get('/',[
      'uses'=>'ExpensesController@getExpensesPage',
      'as'=>'expenses-index'
    ]);

    Route::post('store',[
      'uses'=>'ExpensesController@store',
      'as'=>'expense-store'
    ]);
  });

  Route::group(['prefix'=>'admin'],function(){
    Route::get('/',[
      'uses'=>'AdminController@getIndex',
      'as'=>'admin-index'
    ]);
      Route::get('/users',[
          'uses'=>'AdminController@getAllUsers',
          'as'=>'users-index'
      ]);
  });
});

Auth::routes();
Route::get('logout','Auth\LoginController@logout')->name('logout');
