<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 16-Aug-16 12:25 PM
 * File Name    : shop-routes.php
 */
Route::group(array('prefix' => config('constants_api.API_ROUTE_PREFIX'),'middleware' => ['shop-middleware', 'oauth']), function () {
    Route::group(['namespace' => 'Cartimatic\Shop\Http\Controllers'], function () {
        Route::post('shop/manage-inventory', 'ShopController@manageInventory');
        Route::post('shop/update-sync-status', 'ShopController@updateSyncStatus');
        Route::post('shop/sync-orders', 'ShopController@syncOrders');
        Route::post('shop/sync-damage-lost', 'ShopController@syncDamageLost');
        Route::post('shop/sync-drawer', 'ShopController@syncDrawer');
    });
});

Route::group(array('prefix' => config('constants_api.API_ROUTE_PREFIX'),'middleware' => ['shop-middleware']), function () {
    Route::group(['namespace' => 'Cartimatic\Shop\Http\Controllers'], function () {
        Route::post('shop-login','AuthController@login');
    });
});
