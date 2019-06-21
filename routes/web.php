<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Authorization
Auth::routes(['verify' => true]);

// Localization
Route::get('lang/{locale}', 'DMController@localize')->name('localize');

// Support GET logout
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

// Landing
Route::get('/', 'DMController@landing')->name('landing');

// Authorized users
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('dashboard', 'DMController@dashboard')->name('dashboard');

    // Profile
    Route::get('profile', 'UsersController@profile')->name('profile.index');
    Route::put('profile', 'UsersController@profile_update')->name('profile.update');

    // Only users on subscripion or on trial
    Route::middleware('billing')->group(function () {

        // Confirm Account
        Route::post('account/confirm', 'AccountController@confirm')->name('account.confirm');

        // Export
        Route::get('account/{account}/export/{type}', 'AccountController@export')->name('account.export')->where([
            'type' => '(followers|following)',
        ]);

        // Account management
        Route::resource('account', 'AccountController')->except('show');

        // Search
        Route::post('users/list/search/hashtag', 'ListController@search_hashtag')->name('search.hashtag');

        // Lists management
        Route::group([
            'prefix' => '{type}',
            'where'  => [
                'type' => '(users|messages)',
            ],
        ], function () {
            Route::resource('list', 'ListController')->except('show');
        });

        // Send message
        Route::get('message', 'DMController@message')->name('dm.message');
        Route::post('message', 'DMController@message_send')->name('dm.message_send');

        // Autopilot
        Route::resource('autopilot', 'AutopilotController')->except('show');

        // Notifications
        Route::get('notifications', 'DMController@notifications')->name('notifications');
        Route::put('notifications', 'DMController@mark_notifications')->name('mark.notifications');

        // Direct Messenger
        Route::get('direct', 'DirectController@index')->name('direct.index');
        Route::post('direct/{account}', 'DirectController@inbox')->name('direct.inbox');
        Route::post('direct/{account}/{thread_id}', 'DirectController@thread')->name('direct.thread');
        Route::post('direct/{account}/{thread_id}/send', 'DirectController@send')->name('direct.send');

        // Messages log
        Route::post('log', 'DMController@log_clear')->name('log.clear');

    });

    // Billing
    Route::get('billing', 'BillingController@index')->name('billing.index');
    Route::delete('billing', 'BillingController@cancel')->name('billing.cancel');
    Route::post('billing/{package}', 'BillingController@purchase')->name('billing.purchase');
    Route::get('billing/invoices', 'BillingController@invoices')->name('billing.invoices');
    Route::get('billing/invoices/{invoice_id}', 'BillingController@download_invoice')->name('billing.download_invoice');

    // Administrator
    Route::middleware('can:admin')->prefix('settings')->name('settings.')->group(function () {

        // Settings
        Route::get('/', 'SettingsController@index')->name('index');
        Route::put('/', 'SettingsController@update')->name('update');

        // Packages
        Route::resource('packages', 'PackagesController')->except('show');

        // Users
        Route::resource('users', 'UsersController')->except('show');

        // Proxy
        Route::resource('proxy', 'ProxyController')->except('show');
    });

});

// Handling Stripe Webhooks
Route::post('stripe/webhook', '\Laravel\Cashier\Http\Controllers\WebhookController@handleWebhook')->name('stripe.webhook');

// Install
Route::middleware('installable')->group(function () {
    Route::get('install', 'InstallController@install_check')->name('install.check');
    Route::post('install', 'InstallController@install_db')->name('install.db');
    Route::get('install/setup', 'InstallController@setup')->name('install.setup');
    Route::get('install/administrator', 'InstallController@install_administrator')->name('install.administrator');
    Route::post('install/administrator', 'InstallController@install_finish')->name('install.finish');
});

// Update
Route::middleware('updateable')->group(function () {
    Route::get('update', 'InstallController@update_check')->name('update.check');
    Route::post('update', 'InstallController@update_finish')->name('update.finish');
});

// External Cron
Route::get('cron', 'DMController@cron')->name('cron.external');