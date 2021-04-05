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

/*---------------------------------------------------------------------------------------
*
*									GLOBAL ROUTES
*
*-------------------------------------------------------------------------------------*/
Auth::routes();
Route::get('/home',                                                 'HomeController@index')->name('home');
Route::post('profile_upload',                                       'HomeController@profile_upload')->name('profile_upload');
Route::post('profile_update',                                       'HomeController@profile_update')->name('profile_update');
Route::post('profile_pass_reset',                                   'HomeController@profile_pass_reset')->name('profile_pass_reset');
Route::get('/pending',                                              'PendingController@pending')->name('pending');
Route::resource('area',                                             'AreaController');
Route::resource('file_replacement',                                 'FileReplacementController');
Route::resource('file_damage',                                      'ProductFileDamagesController');


/*---------------------------------------------------------------------------------------
*
*									ADMIN ROUTES
*
*-------------------------------------------------------------------------------------*/
Route::get('profile',                                                   'HomeController@profile')->name('profile');
Route::get('edit_product/{id}',                                         'ProductController@edit_product')->name('edit_product');
Route::resource('product',                                              'ProductController');
Route::resource('stock',                                                'StockController');
Route::resource('fridge',                                               'FridgeController');
Route::post('pull-out',                                                 'FridgeController@pullOut');
Route::post('assign-fridge',                                            'FridgeController@assign');
Route::get('fridge/history/{fridge_id}',                                'FridgeController@fridgeHistory');
Route::get('fridge/edit/history/{status}/{id}/{type}',                  'FridgeController@editHistoryFridge');
Route::resource('order',                                                'OrderController');
Route::get('order/pending/{invoice_id}/{type}/{setId}',                 'OrderController@pendingOrder');
Route::get('order/items/completed/{invoice_id}',                        'StaffDashboardController@pendingOrder');
Route::get('order/completed/{invoice_id}',                              'OrderController@completedOrder');
Route::post('order/cancel/{invoice_id}',                                'OrderController@cancelOrder');
Route::post('order/update/quantity',                                    'OrderController@updateQuantityOrder');
Route::resource('undeliver',                                            'UndeliveredOrderController');
Route::resource('history',                                              'TransactionHistoryOrderController');
Route::resource('sales',                                                'SalesReportController');
Route::resource('loss',                                                 'LossReportController');
Route::resource('emergency',                                            'EmergencyController');
Route::resource('notification',                                         'NotificationController');
Route::resource('order_replacement',                                    'OrderReplacementController');
Route::resource('order_damage',                                         'ProductDamagesController');
Route::resource('ads',                                                  'AdController');
Route::resource('quota',                                                'QuotaController');
Route::get('get/quota/{filter_status}',                            'QuotaController@getQuota');

#client store
Route::get('client/{id}/stores',                                        'ClientController@storeList');
Route::get('client/{id}/stores/json',                                   'ClientController@storeListJson');
Route::get('client/stores/{user_id}/{area_id}/json',                    'ClientController@staffClientStore');
Route::post('replacement/set-deliver',                                  'OrderReplacementController@setDeliveryDate');
Route::get('client/modified/{client_id}/{status}',                      'ClientController@acceptDeclineUserStatus');
Route::get('client/stores/modified/{client_id}/{status}/{store_id}',    'ClientController@acceptDeclineUserStoreStatus');
Route::post('client/stores/add',                                        'ClientController@createClientStore');
Route::get('client/stores/edit/{id}',                                   'ClientController@getClientStore');
Route::get('client/stores/edit/{id}',                                   'ClientController@getClientStore');
Route::post('update/replacement',                                       'OrderReplacementController@updateProducts');
Route::get('client/stores/fridge/{store_id}',                           'StoreController@getClientFridge');

//admin dashboard
Route::get('display_order_to_deliver_count',                            'HomeController@display_order_to_deliver_count')->name('display_order_to_deliver_count');
Route::get('display_order_to_approve_count',                            'HomeController@display_order_to_approve_count')->name('display_order_to_approve_count');
Route::get('display_out_of_stocks_product_count',                       'HomeController@display_out_of_stocks_product_count')->name('display_out_of_stocks_product_count');
Route::get('display_product_of_the_month',                              'HomeController@display_product_of_the_month')->name('display_product_of_the_month');
Route::get('display_weekly_sales_data',                                 'HomeController@display_weekly_sales_data')->name('display_weekly_sales_data');
Route::get('display_sales_data',                                        'HomeController@display_sales_data')->name('display_sales_data');
Route::get('display_loss_data',                                         'HomeController@display_loss_data')->name('display_loss_data');
Route::get('low-stocks',                                                'HomeController@lowStocks')->name('low-stocks');


/*---------------------------------------------------------------------------------------
*
*									STAFF ROUTES
*
*-------------------------------------------------------------------------------------*/
Route::resource('staff',                                                'StaffController');
Route::resource('main',                                                 'StaffDashboardController');
Route::resource('product_list',                                         'StaffProductController');
Route::post('emergency',                                                'StaffDashboardController@emergency');
Route::get('get-sizes/{id}',                                            'ProductController@getSizes');
Route::get('staff-transaction',                                         'StaffDashboardController@staffTransactions');


/*---------------------------------------------------------------------------------------
*
*									CLIENT ROUTES
*
*-------------------------------------------------------------------------------------*/
Route::resource('client',                                               'ClientController');
Route::resource('client_list',                                          'ClientListController');
Route::get('shop',                                                      'ShopController@shop')->name('shop');
Route::post('save_to_cart',                                             'ShopController@save_to_cart')->name('save_to_cart');
Route::resource('store',                                                'StoreController');
Route::get('save_cart',                                                 'CartController@save_cart')->name('save_cart');
Route::resource('cart',                                                 'CartController');
Route::post('damage-cart',                                              'CartController@storeDamageCart');
Route::resource('transaction',                                          'TransactionController');
Route::resource('transaction_history',                                  'TransactionHistoryController');
Route::get('order-success',                                             'TransactionController@thankyou')->name('thankyou');

//client dashboard
Route::get('display_order_to_receive_count_for_client',                 'HomeController@display_order_to_receive_count_for_client')->name('display_order_to_receive_count_for_client');
Route::get('display_order_to_approve_count_for_client',                 'HomeController@display_order_to_approve_count_for_client')->name('display_order_to_approve_count_for_client');
Route::get('display_3_best_product_of_the_month',                       'HomeController@display_3_best_product_of_the_month')->name('display_3_best_product_of_the_month');



//refactor stocks
Route::post('save-edit-stocks',                                         'StockController@createUpdate');
Route::get('stocks-table',                                              'StockController@getStocksTable');
Route::get('stocks/edit/{id}',                                          'StockController@getStocksRow');


//refactor Products
Route::get('product/edit/{id}',                                         'ProductController@getProductRow');

//reports here
Route::get('report/orders',                                             'ReportsController@index');
Route::get('order/reports/json/{filter_status}',                        'ReportsController@getOrders');
Route::get('statistic_reports/{year}',                                  'HomeController@getYearStatistics');