<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 25-Apr-16 1:14 PM
 * File Name    : routes.php
 */

Route::get('users/administration/activate/{activation_code}', 'Admin\UsersController@activateAdminAccount');

Route::group(['middleware' => ['auth', 'admin'], 'namespace' => 'Cartimatic\Admin\Http\Controllers'], function () {

    Route::group(['prefix' => Config::get('constants.ADMIN_URL_PREFIX')], function () {

        Route::group(['prefix' => 'super-admin'], function () {
            Route::get('claims-unassigned', ['as' => 'super-admin.claims-unassigned', 'uses' => 'ClaimController@index']);
            Route::get('claims-assigned', ['as' => 'super-admin.claims-assigned', 'uses' => 'ClaimController@assigned']);
            Route::get('claims-resolved', ['as' => 'super-admin.claims-resolved', 'uses' => 'ClaimController@get_resolved']);

        });

        Route::group(['middleware' => 'role:super.admin'], function () {
            //Route::get('/', ['as' => 'super', 'uses' => 'Admin\SuperAdminController@index']);
            Route::get('/', ['as' => 'admin.home', 'uses' => 'SuperAdminController@index']);
            Route::get('users', ['as' => 'admin.users', 'uses' => 'UsersController@show']);
            Route::get('users/view', 'UsersController@show');
            Route::get('normal-users', ['as' => 'normal.users', 'uses' => 'UsersController@normal_users']);
            Route::get('normal-users-edit/{id}', ['as' => 'normal.users.edit', 'uses' => 'UsersController@normal_users_edit']);
            Route::patch('normal-users-edit/{id}', ['as' => 'normal.users.edit', 'uses' => 'UsersController@update_normal_user']);
            Route::get('login-admin/{id?}', ['as' => 'admin.login', 'uses' => 'UsersController@admin_login']);
            Route::get('user_search', ['as' => 'admin.user.search', 'uses' => 'UsersController@search_user']);

            Route::get('categories/{message?}', ['as' => 'admin.categories', 'uses' => 'SuperAdminController@getCategories']);
            Route::post('save/categories', ['as' => 'save.categories', 'uses' => 'SuperAdminController@storeCategories']);
            Route::post('edit/category/{category_id}', ['as' => 'save.categories', 'uses' => 'SuperAdminController@editCategory']);
            Route::get('delete/category/{category_id}', ['as' => 'delete.categories', 'uses' => 'SuperAdminController@deleteCategory']);
            Route::get('subCategory/{product_id?}', ['as' => 'admin.subCategory', 'uses' => 'SuperAdminController@getSubCategory']);
            Route::post('save/Subcategories', ['as' => 'admin.save.subCategory', 'uses' => 'SuperAdminController@storeSubCategories']);
            Route::post('edit/Subcategory/{category_id?}', ['as' => 'admin.edit.subCategory', 'uses' => 'SuperAdminController@editSubCategory']);
            Route::get('delete/Subcategories/{category_id}', ['as' => 'admin.edit.subCategory', 'uses' => 'SuperAdminController@deleteSubCategory']);
            Route::post('filteredCategory', ['as' => 'admin.filteredCategory', 'uses' => 'SuperAdminController@getSubCategoriesAjax']);
            Route::post('filteredCategoryAjaxly', ['as' => 'admin.filteredCategoryAjaxly', 'uses' => 'SuperAdminController@getCategoriesAjaxly']);
            Route::post('checkIfAlreadySubCatAjax', ['as' => 'admin.checkIfAlreadySubCatAjax', 'uses' => 'SuperAdminController@getSubCategoriesAjax@checkIfAlreadySubCatAjax']);

            //Settings Routes
            Route::get('settings', ['as' => 'admin.settings', 'uses' => 'SettingsController@index']);
            Route::post('settings-assign-permission', ['as' => 'admin.assign-permission', 'uses' => 'SettingsController@store']);

            //Select Categories For Home Page

            Route::get('home-categories', ['as' => 'admin.home-settings', 'uses' => 'SettingsController@home_categories']);
            Route::post('home-categories', ['as' => 'admin.save-categories', 'uses' => 'SettingsController@save_categories']);

            //new route for category & sub category

            Route::post('main/edit/category/{category_id}', ['as' => 'save.categories', 'uses' => 'SuperAdminController@editCategory']);
            Route::get('main/delete/category/{category_id}', ['as' => 'delete.categories', 'uses' => 'SuperAdminController@deleteCategory']);
            Route::post('main/add/subcategory/{category_id}', ['as' => 'store.subcategories', 'uses' => 'SuperAdminController@storeMainSubCategories']);
            Route::post('upload-image-category', ['as' => 'admin.upload-image-category', 'uses' => 'SuperAdminController@upload_image']);

            Route::post('update-main-category-image', ['as' => 'admin.update-main-image-category', 'uses' => 'SuperAdminController@updateCategoriesImage']);

            //Home Page Settings

            Route::get('home-page-settings', ['as' => 'admin.home-page-settings', 'uses' => 'HomeSettingsController@index']);
            Route::post('home-page-settings', ['as' => 'admin.home-settings', 'uses' => 'HomeSettingsController@postSettings']);
            Route::get('modal/{type}/{id?}', ['as' => 'admin.modal', 'uses' => 'HomeSettingsController@modal']);
            Route::get('edit-item/{id}', ['as' => 'admin.modal.edit', 'uses' => 'HomeSettingsController@edit_item']);
            Route::post('upload-image', ['as' => 'admin.upload-image', 'uses' => 'HomeSettingsController@upload_image']);
            Route::post('upload-banner-slider', ['as' => 'admin.upload-banner-slider', 'uses' => 'HomeSettingsController@uploadBannerSlider']);
            Route::post('save-banner-slider', ['as' => 'admin.save-banner-slider', 'uses' => 'HomeSettingsController@saveBannerSlider']);
            Route::post('delete-slider', ['as' => 'admin.delete-slider', 'uses' => 'HomeSettingsController@deleteSlider']);
            Route::get('publish-category-block/{id}', ['as' => 'admin.publish-block', 'uses' => 'HomeSettingsController@publish']);

            // Category Attributes
            Route::group(['prefix'=>'category'],function(){
                Route::get('add-attribute',['uses'=>'CategoryAttributes@index','as'=>'category.add-attributes']);
                Route::post('get',['uses'=>'CategoryAttributes@getCategories','as'=>'category.get']);
                Route::post('save-attribute',['uses'=>'CategoryAttributes@saveAttributes','as'=>'category.save-attribute']);
                Route::post('get-attributes',['uses'=>'CategoryAttributes@getAttributes','as'=>'category.get-attributes']);
                Route::post('save-values',['uses'=>'CategoryAttributes@saveValues','as'=>'category.save-values']);
                Route::post('delete-values',['uses'=>'CategoryAttributes@deleteValues','as'=>'category.delete-values']);
                Route::post('attribute-value-unique-code', 'CategoryAttributes@isAttrValueUniqueCode');

            });

            // Tax-Category Attributes
          /*  Route::group(['prefix' => 'tax_category'], function () {
                Route::get('all-tax-categories', ['uses' => 'TaxCategory@index', 'as' => 'tax_category.all-tax-categories']);
                Route::get('add-tax-categories', ['uses' => 'TaxCategory@create', 'as' => 'tax_category.add-tax-category']);
                Route::get('delete-tax-categories/{tax_category_id}', ['uses' => 'TaxCategory@delete', 'as' => 'tax_category.delete-tax-category']);
                Route::get('edit-tax-categories/{tax_category_id}', ['uses' => 'TaxCategory@edit', 'as' => 'tax_category.edit-tax-category']);
                Route::post('edit-tax-categories/{tax_category_id}', ['uses' => 'TaxCategory@update', 'as' => 'tax_category.edit-tax-category']);
                Route::post('add-tax-categories', ['uses' => 'TaxCategory@store', 'as' => 'tax_category.add-tax-category']);
            });*/

        });

        Route::post('subCategory/delete', ['as' => 'delete.subCategories', 'uses' => 'SuperAdminController@deleteSubCat']);

        Route::post('update/Subcategory', ['as' => 'admin.update.subCategory', 'uses' => 'SuperAdminController@updateSubCategory']);
        Route::post('saves/Subcategories', ['as' => 'save.subCategories', 'uses' => 'SuperAdminController@storeSubCat']);

        Route::group(['middleware' => 'role:dispute.manager'], function () {

        });

        // =======******   Start Other Routes    ***** ========  //

        Route::get('claims/search', ['as' => 'claim.search', 'uses' => 'ClaimController@search']);

        // =======******    End Other Routes    ***** ========  //

        Route::group(['prefix' => 'users', 'middleware' => ['permission:create.users']], function () {
            //Route::get('/', 'Admin\UsersController@index');
            Route::get('dashboard', 'UsersController@index');
            Route::get('create', 'UsersController@create');
            Route::post('store', 'UsersController@store');

            Route::post('delete', 'UsersController@destroy');
            Route::get('edit/{id}', 'UsersController@edit');
            Route::get('superAdmin/edit/{id}', 'UsersController@superAdminEdit');
            Route::patch('superAdmin/update/{id}', 'UsersController@superAdminUpdate');
            Route::patch('update/{id}', 'UsersController@update');
            Route::post('userStatus', 'UsersController@userActiveDisabled');
            Route::post('userStatus', 'UsersController@userActiveDisabled');
//            Route::get( 'activate/{activation_code}', 'Admin\UsersController@activateAdminAccount' );
        });

        Route::group(['prefix' => 'transactions'], function () {
            Route::get('/', 'TransactionsController@index');
        });

        //Other Routes

        Route::get('claim-detail/{id}', ['as' => 'claims-detail', 'uses' => 'ClaimController@claim_detail']);
        Route::post('claim/assign', ['as' => 'claim.assign', 'uses' => 'ClaimController@assign']);
        Route::get('claim/assign/{id}', ['as' => 'claim.assign', 'uses' => 'ClaimController@assign_arbitrator']);
        Route::post('claim/resolved', ['as' => 'claim.resolved', 'uses' => 'ClaimController@resolved']);

        Route::post('claim/message', 'ClaimController@message');

        Route::get('affiliateWithdrawalRequests', 'TransactionsController@affiliateWithdrawalRequests');
        Route::get('withdrawalRequests', 'TransactionsController@withddrawalRequests');
        Route::get('viewPaymentMethodDetails/{id}', 'TransactionsController@viewPaymentMethodDetails');
        Route::get('chagePaymentStatus/{id}', 'TransactionsController@chagePaymentStatus');
        Route::get('startPaymentProcess/{id}', 'TransactionsController@startPaymentProcess');
        Route::get('claimRequests', 'TransactionsController@claimRequests');
        Route::get('startClaimPaymentProcess/{id}', 'TransactionsController@startClaimPaymentProcess');
        Route::get('viewBankDetails/{id}', 'TransactionsController@viewBankDetails');
        Route::get('chageClaimPaymentStatus/{id}', 'TransactionsController@chageClaimPaymentStatus');
        Route::post('saveClaimPaymentinfo/{id}', 'TransactionsController@saveClaimPaymentinfo');
        Route::get('viewPaymentInfo/{id}', 'TransactionsController@viewPaymentInfo');
        Route::get('makeClaimPayment/{id}', 'TransactionsController@makeClaimPayment');
        Route::get('getClaimInfo/{id}', 'TransactionsController@getClaimInfo');

        Route::post('savePaymentinfo/{id}', 'TransactionsController@savePaymentinfo');
        Route::get('getAttachment/{type}/{id}/{name}', 'TransactionsController@getAttachment');
        Route::get('changePassword/{id}', 'UsersController@changePassword');
        Route::patch('changePassword/update/{id}', 'UsersController@adminUpdatePassword');

        Route::group(['prefix' => 'requests'], function () {
            Route::get('/', 'SettingsController@allRequests');
            Route::post('status-changed', 'SettingsController@statusChange');
            Route::get('view-description/{id}', 'SettingsController@viewDescription');
            Route::get('resolved-status', 'SettingsController@allResolved');
        });

        //Sheraz Routes:

        Route::group(['prefix' => 'contact'], function () {
            Route::get('contact-request', ['uses' => 'ContactRequestController@index', 'as' => 'contact.contact-request']);
            Route::get('reject/{id}', ['uses' => 'ContactRequestController@reject', 'as' => 'contact.reject']);
            Route::get('create-user/{id}', ['uses' => 'ContactRequestController@createUser', 'as' => 'contact.create-user']);
            Route::post('save-user', ['uses' => 'ContactRequestController@saveUser', 'as' => 'contact.save-user']);
            

        });
    });
});
Route::group(['namespace' => 'Cartimatic\Admin\Http\Controllers'], function () {
    Route::get('photo/{type}/{file_name}', 'HomeSettingsController@getPhoto');

});
