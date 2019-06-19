<?php

Route::group(['prefix' => 'admin', 'middleware' => ['admin', 'auth:admin']], function () {

// ++++++++++++++++++++ Banner Category Management ++++++++++++++++++++

    //add
    Route::get('/extensionsvalley/banners/addbannercategory', [
        'middleware' => 'acl:add',
        'name' => 'Add Banner Category',
        'as' => 'extensionsvalley.admin.addbannercategory',
        'uses' => 'ExtensionsValley\Banners\BannerCategoryController@addCategory',
    ]);
    // save
    Route::post('/extensionsvalley/banners/savebannercategory', [
        'middleware' => 'acl:add',
        'name' => 'Save Banner Category',
        'as' => 'extensionsvalley.admin.savebannercategory',
        'uses' => 'ExtensionsValley\Banners\BannerCategoryController@saveCategory',
    ]);
    //edit
    Route::get('/extensionsvalley/banners/editbannercategory/{id}', [
        'middleware' => 'acl:edit',
        'name' => 'Edit Banner Category',
        'as' => 'extensionsvalley.admin.editbannercategory',
        'uses' => 'ExtensionsValley\Banners\BannerCategoryController@editCategory',
    ]);
    //update
    Route::post('/extensionsvalley/banners/updatebannercategory', [
        'middleware' => 'acl:edit',
        'name' => 'Save Banner Category',
        'as' => 'extensionsvalley.admin.updatebannercategory',
        'uses' => 'ExtensionsValley\Banners\BannerCategoryController@updateCategory',
    ]);
    // view
     Route::get('/extensionsvalley/banners/viewbannercategory/{id}', [
        'middleware' => 'acl:view',
        'name' => 'View Banner Category',
        'as' => 'extensionsvalley.admin.viewbannercategory',
        'uses' => 'ExtensionsValley\Banners\BannerCategoryController@viewbannerCategory',
    ]);

// ++++++++++++++++++++ Banner Management ++++++++++++++++++++
     // add
    Route::get('/extensionsvalley/banners/addbanners', [
        'middleware' =>  'acl:add',
        'name' => 'Add Banners',
        'as' => 'extensionsvalley.admin.addbanners',
        'uses' => 'ExtensionsValley\Banners\BannerController@addBanner',
    ]);
    // save
    Route::post('/extensionsvalley/banners/savebanners', [
        'middleware' => 'acl:add',
        'name' => 'Save Banners',
        'as' => 'extensionsvalley.admin.savebanners',
        'uses' => 'ExtensionsValley\Banners\BannerController@saveBanner',
    ]);
    // edit
    Route::get('/extensionsvalley/banners/editbanners/{id}', [
        'middleware' => 'acl:edit',
        'name' => 'Edit Banners',
        'as' => 'extensionsvalley.admin.editbanners',
        'uses' => 'ExtensionsValley\Banners\BannerController@editBanner',
    ]);
    // update
    Route::post('/extensionsvalley/banners/updatebanners', [
        'middleware' => 'acl:edit',
        'name' => 'Save Banners',
        'as' => 'extensionsvalley.admin.updatebanners',
        'uses' => 'ExtensionsValley\Banners\BannerController@updateBanner',
    ]);
    // view
     Route::get('/extensionsvalley/banners/viewbanners/{id}', [
        'middleware' => 'acl:view',
        'name' => 'View Banner Category',
        'as' => 'extensionsvalley.admin.viewbanners',
        'uses' => 'ExtensionsValley\Banners\BannerController@viewBanners',
    ]);

});