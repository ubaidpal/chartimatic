<?php

Route::post('postContactUs','HomeController@saveContactUsForm');

Route::get('store/admin/deleteAllBackStageProducts','\Cartimatic\Store\Http\admin\StoreAdminController@deleteAllBackStageProducts');

Route::get('store/login','HomeController@getLoginPage');
Route::get('online-store','HomeController@onlineStore');
Route::get('pos','HomeController@getPos');
Route::get('orders','HomeController@getMyOrders');
Route::get('checkout/{storeBrandId}/{store_id}','HomeController@checkout');
Route::get('cart/delete/{product_id}','HomeController@deleteCartProduct');
Route::get('cart/{message?}','HomeController@getCart');
Route::get('pages/{page_id}','HomeController@getPageByID');
Route::get('/logout', 'Auth\AuthController@getLogout');
Route::get('/login', 'Auth\AuthController@getLogin');

Route::get('/view-product/{product_id}','HomeController@getProductByID');

Route::get('/main.css','HomeController@getStyleSheet');

Route::get('/my-profile', '\Cartimatic\Store\Http\StoreController@myProfile');
Route::post('/save-user-profile-info', '\Cartimatic\Store\Http\StoreController@saveMyProfile');
Route::post('/update_user_profile_picture', '\Cartimatic\Store\Http\StoreController@saveMyProfilePhoto');

Route::get( '/home', function () {
    return redirect( '/' );
} );
Route::post('passwords/resets' ,'Auth\AuthController@postReset');

//help pages
Route::get('help/create-an-account', 'HomeController@helpCreateAnAccount');
Route::get('migrate_me', 'HomeController@migrate_me');
Route::get('help/making-payments', 'HomeController@helpMakingPayments');
Route::get('help/delivery-options', 'HomeController@helpDeliveryOptions');
Route::get('help/buyer-protection', 'HomeController@helpBuyerProtection');
Route::get('help/new-user-guide', 'HomeController@helpNewUserGuide');
//end of help pages

Route::get('contact-us', 'HomeController@contactUs');
Route::get('site-map', 'HomeController@siteMap');

Route::get('partnership', 'HomeController@partnership');
Route::get('affiliate-program', 'HomeController@affiliateProgram');

Route::get('/new-arrivals', 'HomeController@getNewArrivals');
Route::get('/top-sellers', 'HomeController@getTopSellers');
Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/auth/stepOne', 'Auth\AuthController@stepOne');
Route::post('/auth/stepTwo', 'Auth\AuthController@stepTwo');
Route::post('/auth/stepTwoBrand', 'Auth\AuthController@stepTwoBrand');
Route::post('/auth/register', 'Auth\AuthController@postRegister');

Route::post('auth/isValidEmail','Auth\AuthController@validateEmail');

Route::post('saveProfilePicture', 'Auth\AuthController@saveProfilePicture');

Route::controllers([
    'auth'     => 'Auth\AuthController',
    'password' => 'Auth\PasswordController'
]);

Route::get('/resendEmail', 'Auth\AuthController@resendEmail');
Route::get('/activate/{code}', 'Auth\AuthController@activateAccount');
Route::get('user/already-registered', 'Auth\AuthController@userAlreadyRegistered');

Route::get('/resendEmail', 'Auth\AuthController@resendEmail');
Route::get('/activate/{code}', 'Auth\AuthController@activateAccount');

Route::get('/', ['uses' => 'HomeController@index', 'as' => 'home']);

Route::get('static/index', 'StaticInterfacesController@index');

Route::get('settings/general', 'UsersController@generalSetting');
Route::post('settings/generalSettingSave', 'UsersController@generalSettingSave');

Route::get('settings/privacy', 'UsersController@privacySetting');
Route::post('privacySetting', 'UsersController@postSetting');

Route::get('settings/notification', 'UsersController@notificationSetting');

Route::get('settings/change-password', 'UsersController@changePassword');
Route::post('settings/password_change', 'UsersController@userPasswordChange');
//==================== Profile Changes============================
Route::get('store/userProfileChanges', 'UsersController@getProfile');
Route::post('store/saveProfileChanges/{message?}', 'UsersController@updateProfile');
//==================== End Changes============================
Route::get('settings/delete-account', 'UsersController@deleteAccountpage');

Route::get('all-categories', 'HomeController@allCategories');
Route::get('category/{category}/{sorting?}/{perPage?}', 'HomeController@getCategoryIndex');
Route::get('products/{parent_category}', 'HomeController@getAllProductsCategory');
//==================== Reset Password============================
Route::get('passwords/reset/{token?}', 'Auth\AuthController@resetPassword');


Route::post('delete_account', 'UsersController@postDeleteAccount');

Route::group(['middleware' => ['auth', 'data']], function () {
    Route::group(['prefix' => 'messages'], function () {

        Route::get('/', 'MessageController@index');
        Route::get('seller-messages', 'MessageController@index');
        Route::post('/store', 'MessageController@store');
        Route::post('/create-group', 'MessageController@create_group');
        Route::post('/add-member-to-group', 'MessageController@add_member_to_group');
        Route::post('/new-message', 'MessageController@get_new_message');
        Route::get('new-thread', 'MessageController@get_new_message');
        Route::post('/rename-conversation', 'MessageController@update');
        Route::get('leave-group/{id}', 'MessageController@leave_group');
        Route::post('get-thread', 'MessageController@get_thread');
        Route::post('members-detail', 'MessageController@get_user_detail');
        Route::post('get-group-name', 'MessageController@get_conv_name');
        Route::get('leave-group-api/{id}/{user}', 'MessageController@leave_group');
        Route::post('upload-attachment', 'MessageController@upload_attachment');
        Route::post('friends-detail', 'MessageController@get_friends_detail');
        Route::post('getUserByID', 'MessageController@getUserByID');
        Route::post('save-chat-message', 'MessageController@store');
        Route::get('contact-bidder/{seller_id}', ['uses' => 'MessageController@contactBidder', 'as' => 'contact-bidder']);

        Route::get('show/{id}', 'MessageController@get_messages');
        Route::get('show/seller/{id}', 'MessageController@get_messages');
        Route::post('/{userid}/{id}', 'MessageController@show');
        Route::get('/{userid}/{id}', 'MessageController@get_messages');

    });

});

Route::group(['prefix' => 'social'], function () {
    Route::get('{provider}', 'Auth\SocialController@getSocialRedirect');
    Route::get('handle/{provider}', 'Auth\SocialController@handle');
});

Route::get('photo/{type}','HomeController@getPhoto');
Route::post('send-request','HomeController@contactRequest');
Route::get('renderPhoto/{type}/{file_name}/{fileType?}', 'HomeController@getPhoto');
Route::group(['prefix' => 'cron'], function () {
    Route::get('check-products', 'CronController@checkProducts');
});

// Request Routes
include( 'routes/html.php' );
include( 'routes/api-routes.php' );
