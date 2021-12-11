<?php

Route::group(['prefix' => 'v1', 'as' => 'admin.', 'namespace' => 'Api\V1\Admin'], function () {
    Route::apiResource('permissions', 'PermissionsApiController');

    Route::apiResource('roles', 'RolesApiController');

    Route::apiResource('users', 'UsersApiController');

    Route::apiResource('products', 'ProductsApiController');
});
Route::post('login', 'Api\V1\Admin\LoginApiController@login');
Route::group(['prefix' => 'v1', 'as' => 'customer.', 'namespace' => 'Api\V1\Admin'], function () {
    Route::post('register', 'Api\UserController@register');
    Route::post('forgot_password', 'Api\UserController@forgotPassword');
});

