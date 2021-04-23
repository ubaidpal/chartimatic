<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 09-Aug-16
 * Time: 11:40 AM
 */
Route::group(['middleware' => ['auth','data'], 'namespace' => 'Cartimatic\Shop\Http\Controllers'], function () {
    Route::group(['prefix' => 'admin/store'], function () {
        Route::get('add-shop', 'ShopController@create');
        Route::post('store-shop', 'ShopController@store');
        Route::post('shop/update/{id}', 'ShopController@update');
        Route::get('shop/edit/{id}', 'ShopController@edit');
        Route::get('shop/push-items/{id}', 'ShopController@pushItems');
        Route::get('shop/manage-inventory/{id}', 'ShopController@manageInventory');
        Route::any('shop/view-sales/{id}', 'ShopController@viewSales');
        Route::get('shop/bulk-add-items/{id}', 'ShopController@bulkAddItems');
        Route::get('shop/sales-history/{id}', 'ShopController@salesHistory');
        Route::get('shop/all-products/{id}', 'ShopController@allProducts');
        Route::get('shop/shop-product/{id}', 'ShopController@productsByShop');
        Route::get('shop/lost/{id}', 'ShopController@lost');
        Route::post('shop/push-items/{id?}', 'ShopController@postPushItems');
        Route::resource('shop', 'ShopController');
    });
});
include( 'routes/shop-routes.php' );
