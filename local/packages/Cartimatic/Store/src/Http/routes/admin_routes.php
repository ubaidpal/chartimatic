<?php
Route::group(['middleware' => ['data']], function () {
    Route::post('store/{storeBrandId}/admin/add-product1/', 'Cartimatic\Store\Http\admin\StoreAdminController@storeProduct1');
    Route::post('store/{storeBrandId}/admin/getAdvancedSearchAttributes', 'Cartimatic\Store\Http\admin\StoreAdminController@getAdvancedSearchAttributes');
    Route::post('store/saveBasicProductInfo', 'Cartimatic\Store\Http\admin\StoreAdminController@saveBasicProductInfo');
    Route::post('store/saveSpecifications', 'Cartimatic\Store\Http\admin\StoreAdminController@saveSpecifications');
    Route::post('store/saveInventoryPricing', 'Cartimatic\Store\Http\admin\StoreAdminController@saveInventoryPricing');
    Route::post('store/getCategories', 'Cartimatic\Store\Http\admin\StoreAdminController@getCategoriesJSON');
    Route::post('store/getParentLineItems', 'Cartimatic\Store\Http\admin\StoreAdminController@getParentLineItemsJSON');
    Route::post('store/shipping-cost', 'Cartimatic\Store\Http\admin\StoreAdminController@shippingCost');
    Route::get('print-barcode/{id}', 'Cartimatic\Store\Http\admin\StoreAdminController@print_barcode');
    Route::get('my-products', 'Cartimatic\Store\Http\admin\StoreAdminController@myProducts');
    Route::post('store/product-attributes', 'Cartimatic\Store\Http\admin\StoreAdminController@productAttributes');
});
Route::group(['middleware' => ['data'], 'namespace' => 'Cartimatic\Store\Http'], function () {
    Route::group(['prefix' => 'store/{storeBrandId}/admin'], function () {
        Route::post('opening-stock', 'admin\StoreAdminController@addOpeningStock');
        Route::post('delete-keeping', 'admin\StoreAdminController@deleteKeeping');
        Route::post('update-price', 'admin\StoreAdminController@updatePrice');
        Route::post('get-variation-list', 'admin\StoreAdminController@getVariations');

    });

});

Route::group(['middleware' => ['data', 'store_auth']], function () {

    Route::get('store/{storeBrandId}/admin/subscription','Cartimatic\Store\Http\admin\StoreManagementController@subscription');

    Route::get('store/{storeBrandId}/admin/pickSubscriptionPlan/{type}','Cartimatic\Store\Http\admin\StoreManagementController@pickSubscriptionPlan');

    Route::get('store/{storeBrandId}/admin/bank-transfer','Cartimatic\Store\Http\admin\StoreManagementController@bankTransfer');

    Route::get('store/{storeBrandId}/admin/salesChannel','Cartimatic\Store\Http\admin\StoreManagementController@salesChannel');

    Route::get('store/{storeBrandId}/admin/general-settings','Cartimatic\Store\Http\admin\StoreManagementController@generalSettings');

    Route::get('store/{storeBrandId}/admin/generatePDF', 'Cartimatic\Store\Http\admin\StoreManagementController@generatePDF');

    Route::get('store/{storeBrandId}/admin/searchProducts', 'Cartimatic\Store\Http\admin\StoreManagementController@searchProducts');

    Route::post('store/{storeBrandId}/admin/postPurchaseOrder', 'Cartimatic\Store\Http\admin\StoreManagementController@postPurchaseOrder');

    Route::get('store/{storeBrandId}/admin/purchase-orders', 'Cartimatic\Store\Http\admin\StoreManagementController@getPurchaseOrders');

    Route::get('store/{storeBrandId}/admin/purchase-order', 'Cartimatic\Store\Http\admin\StoreManagementController@purchaseOrder');

    Route::post('store/{storeBrandId}/admin/upload', 'Cartimatic\Store\Http\admin\StoreManagementController@upload');

    /*-------------------------------------------------------------------------------------------------------------------------------*/

    Route::get('store/{storeBrandId}/admin/suppliers', 'Cartimatic\Store\Http\admin\StoreManagementController@suppliers');

    Route::get('store/{storeBrandId}/admin/addSupplier/{supplier_id?}', 'Cartimatic\Store\Http\admin\StoreManagementController@addSupplier');

    Route::post('store/{storeBrandId}/admin/postSupplier', 'Cartimatic\Store\Http\admin\StoreManagementController@postSupplier');

    Route::get('store/{storeBrandId}/admin/deleteSupplier/{supplier_id}', 'Cartimatic\Store\Http\admin\StoreManagementController@deleteSupplier');

    /*--------------------------------------------------------------------------------------------------------------------------------*/

    Route::get('store/{storeBrandId}/admin/brands', 'Cartimatic\Store\Http\admin\StoreManagementController@brands');

    Route::get('store/{storeBrandId}/admin/addBrand/{supplier_id?}', 'Cartimatic\Store\Http\admin\StoreManagementController@addBrand');

    Route::post('store/{storeBrandId}/admin/postBrand', 'Cartimatic\Store\Http\admin\StoreManagementController@postBrand');

    Route::get('store/{storeBrandId}/admin/deleteBrand/{supplier_id}', 'Cartimatic\Store\Http\admin\StoreManagementController@deleteBrand');

    /*--------------------------------------------------------------------------------------------------------------------------------*/

    Route::get('store/{storeBrandId}/admin/productGroups', 'Cartimatic\Store\Http\admin\StoreManagementController@productGroups');

    /*---------------------------------------------------Product Template----------------------------------------------------*/
    Route::get('store/{storeBrandId}/admin/productTemplate', 'Cartimatic\Store\Http\admin\StoreManagementController@productTemplate');

    Route::post('store/{storeBrandId}/admin/savedProductTemplate', 'Cartimatic\Store\Http\admin\StoreManagementController@savedProductTemplate');

    /* Route::get('store/{storeBrandId}/admin/editProductTemplate/{product_id?}','Cartimatic\Store\Http\admin\StoreManagementController@editProductTemplate');

     Route::post('store/{storeBrandId}/admin/updateProductTemplate/{product_id?}','Cartimatic\Store\Http\admin\StoreManagementController@updateProductTemplate');*/

    Route::get('store/{storeBrandId}/admin/deleteProductTemplate/{product_id?}', 'Cartimatic\Store\Http\admin\StoreManagementController@deleteProductTemplate');

    Route::post('store/{storeBrandId}/admin/productTemplateFilter', 'Cartimatic\Store\Http\admin\StoreManagementController@productTemplateFilter');
    /*---------------------------------------------------End Product Template-----------------------------------------------*/

    /*---------------------------------------------------Unit----------------------------------------------------*/
    Route::get('store/{storeBrandId}/admin/unit', 'Cartimatic\Store\Http\admin\StoreManagementController@unit');

    Route::post('store/{storeBrandId}/admin/savedUnit', 'Cartimatic\Store\Http\admin\StoreManagementController@savedUnit');

    Route::get('store/{storeBrandId}/admin/editUnit/{product_id?}', 'Cartimatic\Store\Http\admin\StoreManagementController@editUnit');

    Route::post('store/{storeBrandId}/admin/updateUnit/{product_id?}', 'Cartimatic\Store\Http\admin\StoreManagementController@updateUnit');

    Route::get('store/{storeBrandId}/admin/deleteUnit/{product_id?}', 'Cartimatic\Store\Http\admin\StoreManagementController@deleteUnit');
    /*---------------------------------------------------Unit-----------------------------------------------*/

    /*---------------------------------------------------Product Group----------------------------------------------------*/
    Route::get('store/{storeBrandId}/admin/productGroup', 'Cartimatic\Store\Http\admin\StoreManagementController@productGroup');

    Route::post('store/{storeBrandId}/admin/savedProductGroup', 'Cartimatic\Store\Http\admin\StoreManagementController@savedProductGroup');

    /* Route::get('store/{storeBrandId}/admin/editProductGroups/{product_id?}','Cartimatic\Store\Http\admin\StoreManagementController@editProductGroups');

     Route::post('store/{storeBrandId}/admin/updateProductGroups/{product_id?}','Cartimatic\Store\Http\admin\StoreManagementController@updateProductGroups');

     Route::get('store/{storeBrandId}/admin/deleteProductGroups/{product_id?}','Cartimatic\Store\Http\admin\StoreManagementController@deleteProductGroups');*/

    Route::post('store/{storeBrandId}/admin/productGroupFilter', 'Cartimatic\Store\Http\admin\StoreManagementController@productGroupsFilter');
    /*---------------------------------------------------End Product Group-----------------------------------------------*/

    /*---------------------------------------------------Line Item----------------------------------------------------*/
    /*Route::get('store/{storeBrandId}/admin/lineItem','Cartimatic\Store\Http\admin\StoreManagementController@lineItem');

    Route::post('store/{storeBrandId}/admin/savedLineItem','Cartimatic\Store\Http\admin\StoreManagementController@savedLineItem');

     Route::get('store/{storeBrandId}/admin/editLineItem/{product_id?}','Cartimatic\Store\Http\admin\StoreManagementController@editLineItem');

     Route::post('store/{storeBrandId}/admin/updateLineItem/{product_id?}','Cartimatic\Store\Http\admin\StoreManagementController@updateLineItem');

     Route::get('store/{storeBrandId}/admin/deleteLineItem/{product_id?}','Cartimatic\Store\Http\admin\StoreManagementController@deleteLineItem');*/

    /*---------------------------------------------------End Line Item-----------------------------------------------*/

    /*---------------------------------------------------Age Group----------------------------------------------------*/
    Route::get('store/{storeBrandId}/admin/ageGroup', 'Cartimatic\Store\Http\admin\StoreManagementController@ageGroup');

    Route::post('store/{storeBrandId}/admin/savedAgeGroup', 'Cartimatic\Store\Http\admin\StoreManagementController@savedAgeGroup');

    Route::get('store/{storeBrandId}/admin/editAgeGroup/{product_id?}', 'Cartimatic\Store\Http\admin\StoreManagementController@editAgeGroup');

    Route::post('store/{storeBrandId}/admin/updateAgeGroup/{product_id?}', 'Cartimatic\Store\Http\admin\StoreManagementController@updateAgeGroup');

    Route::get('store/{storeBrandId}/admin/deleteAgeGroup/{product_id?}', 'Cartimatic\Store\Http\admin\StoreManagementController@deleteAgeGroup');

    Route::post('store/{storeBrandId}/admin/ageGroupFilter', 'Cartimatic\Store\Http\admin\StoreManagementController@ageGroupFilter');
    /*---------------------------------------------------End Age Group-----------------------------------------------*/

    /*---------------------------------------------------Code Tax----------------------------------------------------*/
    Route::get('store/{storeBrandId}/admin/all-tax-categories', 'Cartimatic\Store\Http\admin\StoreManagementController@allTaxCategories');

    Route::get('store/{storeBrandId}/admin/get-add-tax-categories', 'Cartimatic\Store\Http\admin\StoreManagementController@getAddTaxCategories');

    Route::post('store/{storeBrandId}/admin/add-tax-categories', 'Cartimatic\Store\Http\admin\StoreManagementController@addTaxCategories');

    Route::get('store/{storeBrandId}/admin/delete-tax-categories/{tax_category_id}', 'Cartimatic\Store\Http\admin\StoreManagementController@deleteTaxCategories');

    Route::get('store/{storeBrandId}/admin/edit-tax-categories/{tax_category_id}', 'Cartimatic\Store\Http\admin\StoreManagementController@getEditTaxCategories');

    Route::post('store/{storeBrandId}/admin/edit-tax-categories/{tax_category_id}', 'Cartimatic\Store\Http\admin\StoreManagementController@updateEditTaxCategories');

    /*---------------------------------------------------End Code Tax-----------------------------------------------*/

    /*---------------------------------------------------Calender Season----------------------------------------------------*/
    Route::get('store/{storeBrandId}/admin/calenderSeason', 'Cartimatic\Store\Http\admin\StoreManagementController@calenderSeason');

    Route::post('store/{storeBrandId}/admin/addCalenderSeason', 'Cartimatic\Store\Http\admin\StoreManagementController@addCalenderSeason');

    Route::get('store/{storeBrandId}/admin/deleteCalenderSeason/{tax_category_id}', 'Cartimatic\Store\Http\admin\StoreManagementController@deleteCalenderSeason');

    Route::get('store/{storeBrandId}/admin/getEditCalenderSeason/{tax_category_id}', 'Cartimatic\Store\Http\admin\StoreManagementController@getEditCalenderSeason');

    Route::post('store/{storeBrandId}/admin/updateCalenderSeason/{tax_category_id}', 'Cartimatic\Store\Http\admin\StoreManagementController@updateCalenderSeason');

    /*---------------------------------------------------Calender Season-----------------------------------------------*/

    Route::get('store/{storeBrandId}/admin/addProductGroup/{supplier_id?}', 'Cartimatic\Store\Http\admin\StoreManagementController@addProductGroup');

    Route::post('store/{storeBrandId}/admin/postProductGroup', 'Cartimatic\Store\Http\admin\StoreManagementController@postProductGroup');

    Route::get('store/{storeBrandId}/admin/deleteProductGroup/{supplier_id}', 'Cartimatic\Store\Http\admin\StoreManagementController@deleteProductGroup');

    /*--------------------------------------------------------------------------------------------------------------------------------*/

    /*---------------------------------------------------Life Type----------------------------------------------------*/
    Route::get('store/{storeBrandId}/admin/lifeType', 'Cartimatic\Store\Http\admin\StoreManagementController@lifeType');

    Route::post('store/{storeBrandId}/admin/savedLifeType', 'Cartimatic\Store\Http\admin\StoreManagementController@savedLifeType');

    Route::get('store/{storeBrandId}/admin/editLifeType/{product_id?}', 'Cartimatic\Store\Http\admin\StoreManagementController@editLifeType');

    Route::post('store/{storeBrandId}/admin/updateLifeType/{product_id?}', 'Cartimatic\Store\Http\admin\StoreManagementController@updateLifeType');

    Route::get('store/{storeBrandId}/admin/deleteLifeType/{product_id?}', 'Cartimatic\Store\Http\admin\StoreManagementController@deleteLifeType');
    /*---------------------------------------------------End Life Type-----------------------------------------------*/

    /*---------------------------------------------------Product Gender----------------------------------------------------*/
    Route::get('store/{storeBrandId}/admin/productGender', 'Cartimatic\Store\Http\admin\StoreManagementController@productGender');

    Route::post('store/{storeBrandId}/admin/savedProductGender', 'Cartimatic\Store\Http\admin\StoreManagementController@savedProductGender');

    Route::get('store/{storeBrandId}/admin/editProductGender/{product_id?}', 'Cartimatic\Store\Http\admin\StoreManagementController@editProductGender');

    Route::post('store/{storeBrandId}/admin/updateProductGender/{product_id?}', 'Cartimatic\Store\Http\admin\StoreManagementController@updateProductGender');

    Route::get('store/{storeBrandId}/admin/deleteProductGender/{product_id?}', 'Cartimatic\Store\Http\admin\StoreManagementController@deleteProductGender');
    /*---------------------------------------------------End Product Gender-----------------------------------------------*/

    /*---------------------------------------------------Value Addition----------------------------------------------------*/
    Route::get('store/{storeBrandId}/admin/valueAddition', 'Cartimatic\Store\Http\admin\StoreManagementController@valueAddition');

    Route::post('store/{storeBrandId}/admin/savedValueAddition', 'Cartimatic\Store\Http\admin\StoreManagementController@savedValueAddition');

    Route::get('store/{storeBrandId}/admin/editValueAddition/{product_id?}', 'Cartimatic\Store\Http\admin\StoreManagementController@editValueAddition');

    Route::post('store/{storeBrandId}/admin/updateValueAddition/{product_id?}', 'Cartimatic\Store\Http\admin\StoreManagementController@updateValueAddition');

    Route::get('store/{storeBrandId}/admin/deleteValueAddition/{product_id?}', 'Cartimatic\Store\Http\admin\StoreManagementController@deleteValueAddition');
    /*---------------------------------------------------End Value Addition-----------------------------------------------*/

    Route::post('store/{storeBrandId}/admin/checkStoreName', 'Cartimatic\Store\Http\admin\StoreThemeController@checkStoreName');

    Route::post('store/{storeBrandId}/admin/postStoreEnable', 'Cartimatic\Store\Http\admin\StoreThemeController@postStoreEnable');

    Route::get('store/{storeBrandId}/admin/enableStore', 'Cartimatic\Store\Http\admin\StoreThemeController@enableStore');

    Route::get('store/{storeBrandId}/admin/removeMessage/{message_id}', 'Cartimatic\Store\Http\admin\StoreThemeController@removeMessage');

    Route::get('store/{storeBrandId}/admin/displayMessage/{message_id}', 'Cartimatic\Store\Http\admin\StoreThemeController@getMessage');

    Route::get('store/{storeBrandId}/admin/showContactUsData', 'Cartimatic\Store\Http\admin\StoreThemeController@showContactUsData');

    Route::get('store/{storeBrandId}/admin/domains', 'Cartimatic\Store\Http\admin\StoreThemeController@domains');

    Route::get('store/{storeBrandId}/admin/removeDomain/{domain_id}', 'Cartimatic\Store\Http\admin\StoreThemeController@removeDomain');

    Route::post('store/{storeBrandId}/admin/addDomain', 'Cartimatic\Store\Http\admin\StoreThemeController@addDomain');

    Route::post('store/{storeBrandId}/admin/uploadImage', 'Cartimatic\Store\Http\admin\StoreAdminController@uploadImage');

    Route::get('store/{storeBrandId}/admin/edit-page-layout', 'Cartimatic\Store\Http\admin\StoreAdminController@editBrandPageLayout');
    Route::post('store/{storeBrandId}/admin/edit-page-layout', 'Cartimatic\Store\Http\admin\StoreAdminController@saveBrandPageLayout');
    Route::get('store/{storeBrandId}/admin/getCountriesByRegion', 'Cartimatic\Store\Http\admin\StoreAdminController@getCountriesByRegion');

    Route::get('store/{storeBrandId}/admin/theme/getThemeOption/{theme_id}', 'Cartimatic\Store\Http\admin\StoreThemeController@getThemeOption');

    Route::get('store/{storeBrandId}/admin/theme/setAsDefault/{theme_id}', 'Cartimatic\Store\Http\admin\StoreThemeController@setAsDefault');

    Route::get('store/{storeBrandId}/admin/theme/getHeader/{theme_id}', 'Cartimatic\Store\Http\admin\StoreThemeController@getHeader');

    Route::get('store/{storeBrandId}/admin/theme', 'Cartimatic\Store\Http\admin\StoreThemeController@index');

    Route::get('store/{storeBrandId}/admin/theme/edit/{id}', 'Cartimatic\Store\Http\admin\StoreThemeController@edit');

    Route::get('store/{storeBrandId}/admin/searchProduct', 'Cartimatic\Store\Http\admin\StoreThemeController@searchProduct');

    Route::get('store/{storeBrandId}/admin/searchProductCategory', 'Cartimatic\Store\Http\admin\StoreThemeController@searchProductCategory');

    Route::get('store/{storeBrandId}/admin/pages', 'Cartimatic\Store\Http\admin\StoreThemeController@getPages');

    Route::get('store/{storeBrandId}/admin/addPage/{page_id?}', 'Cartimatic\Store\Http\admin\StoreThemeController@addPage');

    Route::get('store/{storeBrandId}/admin/removePage/{page_id}', 'Cartimatic\Store\Http\admin\StoreThemeController@removePage');

    Route::post('store/{storeBrandId}/admin/storePage/{page_id?}', 'Cartimatic\Store\Http\admin\StoreThemeController@storePage');

    Route::post('store/{storeBrandId}/admin/addNavigationItem/{theme_id}', 'Cartimatic\Store\Http\admin\StoreThemeController@addNavigationItem');

    Route::post('store/{storeBrandId}/admin/addFeaturedProduct/{theme_id}', 'Cartimatic\Store\Http\admin\StoreThemeController@addFeaturedProduct');

    Route::post('store/{storeBrandId}/admin/addCustomSectionProduct/{theme_id}', 'Cartimatic\Store\Http\admin\StoreThemeController@addCustomSectionProduct');

    Route::post('store/{storeBrandId}/admin/removeFeaturedProduct/{theme_id}', 'Cartimatic\Store\Http\admin\StoreThemeController@removeFeaturedProduct');

    Route::post('store/{storeBrandId}/admin/removeFooterNav/{theme_id}', 'Cartimatic\Store\Http\admin\StoreThemeController@removeFooterNav');

    Route::post('store/{storeBrandId}/admin/saveFooterOption/{theme_id}', 'Cartimatic\Store\Http\admin\StoreThemeController@saveFooterOption');

    Route::post('store/{storeBrandId}/admin/addFooterNavItem/{theme_id}', 'Cartimatic\Store\Http\admin\StoreThemeController@addFooterNavItem');

    Route::post('store/{storeBrandId}/admin/editFooterNavItem/{theme_id}', 'Cartimatic\Store\Http\admin\StoreThemeController@editFooterNavItem');

    Route::post('store/{storeBrandId}/admin/saveThemeMenu/{theme_id}', 'Cartimatic\Store\Http\admin\StoreThemeController@saveThemeMenu');

    Route::post('store/{storeBrandId}/admin/saveMenu/{theme_id}', 'Cartimatic\Store\Http\admin\StoreThemeController@saveMenu');

    Route::post('store/{storeBrandId}/admin/removeMenu/{theme_id}', 'Cartimatic\Store\Http\admin\StoreThemeController@removeMenu');

    Route::post('store/{storeBrandId}/removeMenuItem/{theme_id}', 'Cartimatic\Store\Http\admin\StoreThemeController@removeMenuItem');

    Route::post('store/{storeBrandId}/admin/removeFooterNavItem/{theme_id}', 'Cartimatic\Store\Http\admin\StoreThemeController@removeFooterNavItem');

    Route::get('store/{storeBrandId}/admin/theme/getThemeOptionByID/{option_id}', 'Cartimatic\Store\Http\admin\StoreThemeController@getThemeOptionByID');

    Route::post('store/{storeBrandId}/admin/theme/reOrderMenu/{option_id}', 'Cartimatic\Store\Http\admin\StoreThemeController@reOrderMenu');

    Route::post('store/{storeBrandId}/admin/theme/saveThemeOption/{id}', 'Cartimatic\Store\Http\admin\StoreThemeController@saveThemeOption');

    // ==================== Ubaid code ============================
    Route::get('store/{storeBrandId}/admin/add-product/{message?}', 'Cartimatic\Store\Http\admin\StoreAdminController@getAddProduct');

    Route::get('store/{storeBrandId}/admin/add-new-product/{message?}', 'Cartimatic\Store\Http\admin\StoreAdminController@addNewProduct1');

    Route::post('store/{storeBrandId}/admin/auto_save_product_info/{product_id}/{message?}', 'Cartimatic\Store\Http\admin\StoreAdminController@autoSaveNewProduct1');

    Route::get('store/{storeBrandId}/admin/add-product1/{product_id}/{message?}', 'Cartimatic\Store\Http\admin\StoreAdminController@getAddProduct1');

    Route::get('store/{storeBrandId}/admin/edit-product/{product_id}', 'Cartimatic\Store\Http\admin\StoreAdminController@editSellerProduct');

    Route::get('store/{storeBrandId}/admin/feedback/{messages?}', 'Cartimatic\Store\Http\admin\StoreAdminController@getFeedBack');
    Route::get('store/{storeBrandId}/admin/delete/feedback/{feedback_id}', 'Cartimatic\Store\Http\admin\StoreAdminController@deleteFeedBack');

    Route::post('store/{storeBrandId}/admin/search/feedback/{messages?}', 'Cartimatic\Store\Http\admin\StoreAdminController@searchFeedBack');

    Route::get('store/{storeBrandId}/admin/categories/{messages?}', 'Cartimatic\Store\Http\admin\StoreAdminController@getCategories');
    Route::post('store/{storeBrandId}/admin/categories/{messages?}', 'Cartimatic\Store\Http\admin\StoreAdminController@storeCategories');
    Route::get('store/{storeBrandId}/admin/delete/category/{category_id}', 'Cartimatic\Store\Http\admin\StoreAdminController@deleteCategory');
    Route::post('store/{storeBrandId}/admin/add-product/', 'Cartimatic\Store\Http\admin\StoreAdminController@storeProduct');

    Route::post('store/{storeBrandId}/admin/update-product/{product_id}', 'Cartimatic\Store\Http\admin\StoreAdminController@storeProductUpdate');
    Route::post('store/{storeBrandId}/admin/subCategory/', 'Cartimatic\Store\Http\admin\StoreAdminController@getSubCategory');

    Route::post('store/{storeBrandId}/admin/filteredCategory/', 'Cartimatic\Store\Http\admin\StoreAdminController@getSubCategoriesAjax');

    Route::post('store/{storeBrandId}/admin/product_image_ajax/', 'Cartimatic\Store\Http\admin\StoreAdminController@product_image_ajax');
    Route::post('store/{storeBrandId}/admin/delete_product_image/', 'Cartimatic\Store\Http\admin\StoreAdminController@delete_product_image');
    Route::get('store/{storeBrandId}/admin/product/{product_id}/{message?}', 'Cartimatic\Store\Http\admin\StoreAdminController@getProductDetail');
    Route::Post('store/{storeBrandId}/admin/product/delete', 'Cartimatic\Store\Http\admin\StoreAdminController@deleteProductAjax');
    Route::post('store/{storeBrandId}/admin/delete_edit_product_image', 'Cartimatic\Store\Http\admin\StoreAdminController@delete_edit_product_image');

    Route::get('store/{storeBrandId}/admin/{product_id}/product_analytics', 'Cartimatic\Store\Http\admin\StoreAdminController@getProductAnalytics');

    Route::get('store/{storeBrandId}/admin/product_analytics', 'Cartimatic\Store\Http\admin\StoreAdminController@productListingAnalytics');

    Route::post('store/{storeBrandId}/admin/get-product-variants/{product_id?}/{message?}', 'Cartimatic\Store\Http\admin\StoreAdminController@getProductsVariants');

    Route::get('store/{storeBrandId}/admin/page_analytics', 'Cartimatic\Store\Http\admin\StoreAdminController@getPageAnalytics');

    Route::post('store/{storeBrandId}/admin/save-product-for-publish/{product_id}', 'Cartimatic\Store\Http\admin\StoreAdminController@saveProductPublish');
    Route::post('store/{storeBrandId}/admin/save-product-for-draft/{product_id}', 'Cartimatic\Store\Http\admin\StoreAdminController@saveProductDraft');

    // ==================== End of Ubaid code ============================

    Route::post('store/{storeBrandId}/admin/edit/category/{category_id}', 'Cartimatic\Store\Http\admin\StoreAdminController@editCategory');

    Route::get('store/{storeBrandId}/admin/Subcategories/{messages?}', 'Cartimatic\Store\Http\admin\StoreAdminController@getSubCategories');

    Route::get('store/{storeBrandId}/admin/send-request-revise-feedback/{review_id}/{messages?}', 'Cartimatic\Store\Http\admin\StoreAdminController@sendRequestToRvise');

    Route::post('store/{storeBrandId}/admin/Subcategories/{messages?}', 'Cartimatic\Store\Http\admin\StoreAdminController@storeSubCategories');

    Route::post('store/{storeBrandId}/admin/edit/Subcategory/{category_id}', 'Cartimatic\Store\Http\admin\StoreAdminController@editSubCategory');

    Route::get('store/{storeBrandId}/admin/delete/Subcategory/{category_id}', 'Cartimatic\Store\Http\admin\StoreAdminController@deleteSubCategory');

    Route::get('store/{storeBrandId}/admin/manage-product/{messages?}', 'Cartimatic\Store\Http\admin\StoreAdminController@getProducts');

    Route::post('store/{storeBrandId}/admin/manage-product/{messages?}', 'Cartimatic\Store\Http\admin\StoreAdminController@getProducts');

    Route::get('store/{storeBrandId}/admin/delete/product/{product_id}/{m_one?}/{m_one_value?}/{m_two?}/{m_two_value?}', 'Cartimatic\Store\Http\admin\StoreAdminController@deleteProduct');
    Route::post('store/{storeBrandId}/admin/filteredProducts/', 'Cartimatic\Store\Http\admin\StoreAdminController@getProductsForSelection');
    Route::get('store/{storeBrandId}/admin/edit/product/{product_id}', 'Cartimatic\Store\Http\admin\StoreAdminController@editProduct');
    Route::patch('store/{storeBrandId}/admin/update/product/{product_id}', 'Cartimatic\Store\Http\admin\StoreAdminController@updateProduct');
    Route::get('store/{storeBrandId}/admin/orders/{messages?}', 'Cartimatic\Store\Http\admin\StoreAdminOrderController@getOrders');
    Route::post('store/{storeBrandId}/admin/orders/{messages?}', 'Cartimatic\Store\Http\admin\StoreAdminOrderController@getOrders');
    Route::get('store/{storeBrandId}/admin/store-earnings/{messages?}', 'Cartimatic\Store\Http\admin\StoreAdminController@getStoreEarnings');
    Route::post('store/{storeBrandId}/admin/update/order-status/{messages?}', 'Cartimatic\Store\Http\admin\StoreAdminController@updateOrderStatusAjax');
    Route::get('store/{storeBrandId}/admin/manage_reviews/{messages?}', 'Cartimatic\Store\Http\admin\StoreAdminController@manageReviews');
    Route::post('store/{storeBrandId}/admin/add-courier-service-info/{order_id}/{order_status}/{messages?}', 'Cartimatic\Store\Http\admin\StoreAdminController@addCourierServiceInfo');
    Route::post('store/{storeBrandId}/admin/serach-my-orders/{message?}', 'Cartimatic\Store\Http\admin\StoreAdminController@searchMyOrders');
    Route::post('store/{storeBrandId}/admin/serach-my-reviews/{message?}', 'Cartimatic\Store\Http\admin\StoreAdminController@searchMyReviews');

    Route::post('store/{storeBrandId}/admin/checkIfAlreadySubCatAjax/{message?}', 'Cartimatic\Store\Http\admin\StoreAdminController@checkIfAlreadySubCatAjax');

    Route::group(['prefix' => 'store/{storeBrandId}/admin/statement'], function () {
        Route::any('/', 'Cartimatic\Store\Http\admin\StoreAdminController@statement');
    });

    Route::group(['prefix' => 'store/{storeBrandId}/admin/product-analytics'], function () {

        Route::post('number-views/{product_id}', 'Cartimatic\Store\Http\admin\StoreAdminController@number_views');
        Route::post('number-sales/{product_id}', 'Cartimatic\Store\Http\admin\StoreAdminController@number_sales');
        Route::post('age-view/{product_id}', 'Cartimatic\Store\Http\admin\StoreAdminController@age_view');
        Route::post('gender-view/{product_id}', 'Cartimatic\Store\Http\admin\StoreAdminController@gender_view');
        Route::post('country-view/{product_id}', 'Cartimatic\Store\Http\admin\StoreAdminController@country_view');
        Route::post('peak-view/{product_id}', 'Cartimatic\Store\Http\admin\StoreAdminController@peak_view');

        // start of page stats routes
        Route::post('number-views/page/{owner_id}', 'Cartimatic\Store\Http\admin\StoreAdminController@number_views_page_stat');
        Route::post('number-sales/page/{owner_id}', 'Cartimatic\Store\Http\admin\StoreAdminController@number_sales_page_stat');
        Route::post('age-view/page/{owner_id}', 'Cartimatic\Store\Http\admin\StoreAdminController@age_view_page_stat');
        Route::post('gender-view/page/{owner_id}', 'Cartimatic\Store\Http\admin\StoreAdminController@gender_view_page_stat');
        Route::post('country-view/page/{owner_id}', 'Cartimatic\Store\Http\admin\StoreAdminController@country_view_page_stat');
        Route::post('peak-view/page/{owner_id}', 'Cartimatic\Store\Http\admin\StoreAdminController@peak_view_page_stat');
        // end of page stats routes

    });
});
Route::post('store/{storeBrandId}/admin/order/delete/{message?}', 'Cartimatic\Store\Http\admin\StoreAdminController@softDeleteOrder');

Route::post('store/{storeBrandId}/cancelOrder/{order_id}/{message?}', 'Cartimatic\Store\Http\admin\StoreAdminController@cancelOrder');

Route::get('store/{storeBrandId}/admin/order-invoice/{order_id}/{message?}', 'Cartimatic\Store\Http\admin\StoreAdminController@getOrderInvoice');

Route::post('store/{storeBrandId}/admin/getProductCodeTemplates', 'Cartimatic\Store\Http\admin\StoreAdminController@getProductCodeTemplates');

Route::post('store/{storeBrandId}/admin/update-template-increment', 'Cartimatic\Store\Http\admin\StoreAdminController@getCodeIncrement');

Route::get('store/{storeBrandId}/admin/add-product-shipping-cost/{product_id}/{message?}', 'Cartimatic\Store\Http\admin\StoreAdminController@getAddProductShippingCost');

Route::post('store/{storeBrandId}/admin/add-product-shipping-cost/{message?}', 'Cartimatic\Store\Http\admin\StoreAdminController@addProductShippingCost');

// categories
Route::post('store/{storeBrandId}/super-admin/edit/category/{category_id}', 'Cartimatic\Store\Http\admin\StoreSuperAdminController@editCategory');

Route::get('store/{storeBrandId}/super-admin/Subcategories/{messages?}', 'Cartimatic\Store\Http\admin\StoreSuperAdminController@getSubCategories');

Route::post('store/{storeBrandId}/super-admin/Subcategories/{messages?}', 'Cartimatic\Store\Http\admin\StoreSuperAdminController@storeSubCategories');

Route::post('store/{storeBrandId}/super-admin/edit/Subcategory/{category_id}', 'Cartimatic\Store\Http\admin\StoreSuperAdminController@editSubCategory');

Route::get('store/{storeBrandId}/admin/delete/Subcategory/{category_id}', 'Cartimatic\Store\Http\admin\StoreSuperAdminController@deleteSubCategory');

Route::get('store/{storeBrandId}/super-admin/categories/{messages?}', 'Cartimatic\Store\Http\admin\StoreSuperAdminController@getCategories');

Route::post('store/{storeBrandId}/super-admin/categories/{messages?}', 'Cartimatic\Store\Http\admin\StoreSuperAdminController@storeCategories');

Route::get('store/{storeBrandId}/super-admin/delete/category/{category_id}', 'Cartimatic\Store\Http\admin\StoreSuperAdminController@deleteCategory');

Route::post('store/{storeBrandId}/admin/getItemsAgeGroup', 'Cartimatic\Store\Http\admin\StoreAdminController@getItemsAgeGroup');
Route::get('store/{storeBrandId}/admin/getCategoryAttributes', 'Cartimatic\Store\Http\admin\StoreAdminController@getCategoryAttributes');

?>
