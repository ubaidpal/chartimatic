<?php
Route::group(['middleware' => ['auth', 'data']], function () {
    Route::group(['prefix' => 'admin/store/employees', 'namespace' => 'Cartimatic\Store\Http\admin'], function () {
        Route::get('/', 'EmployeesController@index');
        Route::get('create', 'EmployeesController@create');
        Route::post('store', 'EmployeesController@store');
        Route::get('edit/{id}', 'EmployeesController@edit');
        Route::patch('update/{id}', 'EmployeesController@update');
        Route::get('delete/{id}', 'EmployeesController@destroy');
        Route::get('create-role', 'EmployeesController@createRole');
        Route::get('roles', 'EmployeesController@allRole');
        Route::post('storeRole', 'EmployeesController@storeRole');
        Route::get('delete-role/{id}', 'EmployeesController@deleteRole');
        Route::get('edit-role/{id}', 'EmployeesController@getRole');
        Route::post('update-role/{id}', 'EmployeesController@updateRole');
    });
    Route::group(['prefix' => 'admin/store/requests', 'namespace' => 'Cartimatic\Store\Http\admin'], function () {
        Route::post('save-request', 'StoreAdminController@saveRequest');
        Route::get('/', 'StoreAdminController@allRequest');
        Route::get('edit/{id?}', 'StoreAdminController@getEdit');
        Route::get('delete/{id?}', 'StoreAdminController@deleteRequest');
        Route::post('update/{id?}', 'StoreAdminController@updateRequest');
    });
    Route::group(['prefix' => 'admin/store/notifications', 'namespace' => 'Cartimatic\Store\Http'], function () {
        Route::get('/', 'NotificationController@index');
        Route::get('read-notification/{url}/{id}', ['as' => 'read-notification', 'uses' => 'NotificationController@readNotification']);
    });
    Route::post('admin/store/select-pos', 'Cartimatic\Store\Http\admin\StoreAdminController@selectPOS');
    Route::group(['prefix' => 'store'], function () {
        Route::group(['prefix' => 'dispute'], function () {
            Route::get('{id}', 'Cartimatic\Store\Http\StoreOrderController@getOrderDispute');
            Route::post('complain', 'Cartimatic\Store\Http\DisputeController@saveDispute');
            Route::get('detail/{id}/{type?}', 'Cartimatic\Store\Http\DisputeController@get_dispute');
            Route::get('modify/{id}', 'Cartimatic\Store\Http\DisputeController@edit_dispute');
            Route::get('cancel/{id}', 'Cartimatic\Store\Http\DisputeController@cancel_dispute');
            Route::get('accept/{id}', 'Cartimatic\Store\Http\DisputeController@accept_dispute');
            Route::post('message', 'Cartimatic\Store\Http\DisputeController@message');
            Route::post('delete-attachment', 'Cartimatic\Store\Http\DisputeController@delete_attachment');

        });
        Route::post('claim/store', 'Cartimatic\Store\Http\DisputeController@claim_store');

        Route::group(['namespace' => 'Cartimatic\Store\Http\admin'], function () {
            Route::get('{storeBrandId}/admin/orders', 'StoreAdminOrderController@getOrders');
            Route::get('{storeBrandId}/admin/statement', ['uses' => 'StoreAdminController@statement', 'as' => 'store.statement']);

        });
        Route::group(['namespace' => 'Cartimatic\Store\Http\admin'], function () {
            Route::get('{storeBrandId}/admin/orders', 'StoreAdminOrderController@getOrders');
            Route::get('{storeBrandId}/admin/orders', 'StoreAdminOrderController@getOrders');
            Route::get('{storeBrandId}/admin/statement', ['uses' => 'StoreAdminController@statement', 'as' => 'store.statement']);
            Route::post('{storeBrandId}/admin/upload-product-picture', ['uses' => 'StoreAdminController@uploadProductPicture', 'as' => 'store.upload-picture']);

        });
        Route::group(['namespace' => 'Cartimatic\Store\Http'], function () {
            Route::get('{storeBrandId}/admin/withdrawal', ['uses' => 'StoreManagementController@requestWithdrawal', 'as' => 'store.withdrawal']);
            Route::get('{storeBrandId}/admin/bankAccount', ['uses' => 'StoreManagementController@getBankAccount', 'as' => 'store.bankAccount']);

            //Order Routes
            Route::get('my-orders', 'StoreOrderController@getMyOrders');
            Route::get('cancel-order/{orderId}/{userName}/{view}', ['uses' => 'StoreOrderController@orderStatus', 'as' => 'store.order-status']);

            Route::post('get-messages', 'StoreController@getMessages');

            // Reports

        });

        Route::group(['prefix' => 'admin/report', 'namespace' => 'Cartimatic\Store\Http\admin'], function () {
            Route::get('products', ['uses' => 'ReportsController@products', 'as' => 'products']);
            Route::get('product-detail/{id}', ['uses' => 'ReportsController@productDetail', 'as' => 'product-detail']);

            //Sales
            Route::any('sales', ['uses' => 'ReportsController@sales', 'as' => 'sales']);
            Route::get('lost', 'ReportsController@lost');

        });
        Route::group(['prefix' => 'admin/returns', 'namespace' => 'Cartimatic\Store\Http\admin'], function () {
            Route::post('get-detail', ['uses' => 'ReturnsController@getDetail', 'as' => 'returns']);
            Route::post('received', ['uses' => 'ReturnsController@updateStatus', 'as' => 'returns']);
            Route::get('{type}', ['uses' => 'ReturnsController@index', 'as' => 'returns']);
        });

        Route::get('pos/push-items/{id}', 'Cartimatic\Store\Http\admin\StoreAdminController@getProductDetailForPushItems');
    });
    Route::post('dispute-image', 'Cartimatic\Store\Http\DisputeController@product_image_ajax');
    Route::post('delete-dispute-image', 'Cartimatic\Store\Http\DisputeController@delete_product_image');
    Route::get('claimFee/{id}', 'Cartimatic\Store\Http\DisputeController@claimFee');
    Route::post('store/payClaimFee/{id}', 'Cartimatic\Store\Http\DisputeController@payClaimFee');

    Route::group(['prefix' => 'admin', 'namespace' => 'Cartimatic\Store\Http\admin'], function () {
        Route::get('dashboard', 'DashboardController@index');
    });

    Route::group(['prefix' => 'admin/store/grn', 'namespace' => 'Cartimatic\Store\Http\admin'], function () {
        Route::get('/', 'GRNController@index');
        // Route::post('/', 'GRNController@index');
        Route::get('generate', 'GRNController@generateGrn');
        Route::post('generate', 'GRNController@saveGrn');
        Route::post('get-purchase-order', 'GRNController@getPurchaseOrder');
        Route::get('searchProducts', 'StoreManagementController@searchProducts');
        Route::post('product-detail', 'GRNController@getProductDetail');
        Route::post('get-purchase-orders', 'GRNController@getSupplierPurchaseOrders');
        Route::get('edit/{id}', 'GRNController@edit');
        Route::get('generate-pdf/{id}', 'GRNController@generatePDF');
        Route::post('delete-product', 'GRNController@deleteProduct');
        Route::get('upload', 'GRNController@getUpload');
        Route::put('update', 'GRNController@update');
        Route::post('upload', 'GRNController@upload');
        Route::post('print-barcode', 'GRNController@barcodeSession');
        Route::get('print-barcode', 'GRNController@printBarcode');
    });
    Route::group(['namespace' => 'Cartimatic\Store\Http\admin'], function () {
        Route::get('configuration', ['uses' => 'StoreConfigurationsController@configuration', 'as' => 'configuration']);
        Route::post('save-config', ['uses' => 'StoreConfigurationsController@save', 'as' => 'save-config']);
    });
});
