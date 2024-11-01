<?php

Route::group(['prefix' => 'v1', 'as' => 'admin.', 'namespace' => 'Api\V1\Admin'], function () {
    Route::apiResource('permissions', 'PermissionsApiController');

    Route::apiResource('roles', 'RolesApiController');

    Route::apiResource('users', 'UsersApiController');

    Route::apiResource('products', 'ProductsApiController');
});
Route::post('login', 'Api\V1\Admin\LoginApiController@login');
Route::post('register', 'Api\V1\Admin\LoginApiController@register');
Route::post('forgot_password', 'Api\V1\Admin\LoginApiController@forgotPassword');
//Route::group(['prefix' => 'v1', 'as' => 'customer.', 'middleware' => 'auth:customers', 'namespace' => 'Api\V1\Admin'], function () {
Route::group(['middleware' => 'auth:customersapi'], function(){
    Route::get('customers', 'Api\V1\Admin\ProductsApiController@index');
    Route::get('contacts', 'Api\V1\Admin\AppApiController@index');
    Route::post('apply_loan', 'Api\V1\Admin\AppApiController@applyLoan');
    Route::post('import_contacts', 'Api\V1\Admin\AppApiController@importContacts');
    Route::get('rewards', 'Api\V1\Admin\AppApiController@rewards');
    Route::post('update_profile', 'Api\V1\Admin\LoginApiController@profileUpdate');
    Route::post('change_password', 'Api\V1\Admin\LoginApiController@changePassword');
});
Route::group(['prefix' => 'v1', 'as' => 'customer.', 'namespace' => 'Api\V1\Admin'], function () {
});

