<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\LoanController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ReferralController;
use App\Http\Controllers\Admin\SettingController;


Route::redirect('/', '/login');

Route::redirect('/home', '/admin');

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');

    Route::resource('permissions', 'PermissionsController');

    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');

    Route::resource('roles', 'RolesController');

    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');

    Route::resource('users', 'UsersController');

    Route::delete('products/destroy', 'ProductsController@massDestroy')->name('products.massDestroy');

    Route::resource('products', 'ProductsController');
    
                /*----Customer----*/
   // Route::get('customer', [ CustomerController::class, 'index' ])->name('customer');

    Route::delete('customer/destroy', 'CustomerController@massDestroy')->name('customer.massDestroy');

    Route::resource('customer', 'CustomerController');

                /*----Contact----*/

   // Route::get('contact', [ ContactController::class, 'index' ])->name('contact');

    Route::delete('contact/destroy', 'ContactController@massDestroy')->name('contact.massDestroy');

    Route::resource('contact', 'ContactController');

                 /*----Loan----*/    

   // Route::get('loan', [ LoanController::class, 'index' ])->name('loan');

    Route::delete('loan/destroy', 'LoanController@massDestroy')->name('loan.massDestroy');

    Route::resource('loan', 'LoanController');

                /*----Notification----*/   

   // Route::get('notification', [ NotificationController::class, 'index' ])->name('notification');

    Route::delete('notification/destroy', 'LoanController@massDestroy')->name('notification.massDestroy');

    Route::resource('notification', 'NotificationController');

                 /*----Referral----*/  

   // Route::get('referral', [ ReferralController::class, 'index' ])->name('referral');

    Route::delete('referral/destroy', 'ReferralController@massDestroy')->name('referral.massDestroy');

    Route::resource('referral', 'ReferralController');

                /*----Setting----*/ 

   // Route::get('setting', [ SettingController::class, 'index' ])->name('setting');

    Route::delete('setting/destroy', 'SettingController@massDestroy')->name('setting.massDestroy');

    Route::resource('setting', 'SettingController');

});
