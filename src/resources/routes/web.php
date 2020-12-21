<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use PWWEB\Core\Controllers\Address\TypeController;
use PWWEB\Core\Controllers\AddressController;
use PWWEB\Core\Controllers\CountryController;
use PWWEB\Core\Controllers\CurrencyController;
use PWWEB\Core\Controllers\LanguageController;
use PWWEB\Core\Controllers\MenuController;
use PWWEB\Core\Controllers\PersonController;
use PWWEB\Core\Controllers\RoleController;
use PWWEB\Core\Controllers\Tax\LocationController;
use PWWEB\Core\Controllers\Tax\RateController;
use PWWEB\Core\Controllers\UserController;

Route::name('core.')
    ->middleware(['web', 'auth', 'localisation'])
    ->group(
        function () {
            Route::resource('persons', PersonController::class);
            Route::resource('users', UserController::class);
            Route::resource('roles', RoleController::class)->except(['show', 'edit']);
            Route::resource('menus', MenuController::class);
            Route::resource('countries', CountryController::class);
            Route::resource('currencies', CurrencyController::class);
            // Route::resource('exchangerates', ExchangeRateController::class);
            Route::resource('languages', LanguageController::class);
            Route::resource('addresses', AddressController::class);
            Route::namespace('Address')
                ->prefix('address')
                ->name('address.')
                // ->middleware('auth')
                ->group(
                    function () {
                        Route::resource('types', TypeController::class);
                    }
                );
            Route::namespace('Tax')
                ->prefix('tax')
                ->name('tax.')
                ->group(
                    function () {
                        Route::resource('rates', RateController::class);
                        Route::resource('locations', LocationController::class);
                    }
                );
        }
    );

Route::namespace('\PWWEB\Core\Controllers')
    ->name('system.')
    ->prefix('profile')
    ->middleware(['web', 'auth', 'localisation'])
    ->group(
        function () {
            Route::get('/', 'ProfileController@index')->name('profile.index');
            Route::get('/p/{user}', 'ProfileController@show')->name('profile.show');
            Route::get('/edit', 'ProfileController@edit')->name('profile.edit');
            Route::get('/reverify', 'ProfileController@reverify')->name('profile.reverify');
            Route::get('/password', 'ProfileController@password')->name('profile.password');
            Route::get('/befried', 'ProfileController@befriend')->name('profile.befriend');
            Route::post('/store', 'ProfileController@store')->name('profile.store');
            Route::patch('/update', 'ProfileController@update')->name('profile.update');
            Route::patch('/updatePassword', 'ProfileController@updatePassword')->name('profile.password.update');
            Route::patch('/avatar', 'ProfileController@updateAvatar')->name('profile.update.avatar');
            Route::get('/address/show/{address}', '\PWWEB\Core\Controllers\AddressController@show')->name('profile.address.show');
            Route::get('/address/create', 'ProfileController@createAddress')->name('profile.address.create');
            Route::post('/address/store', 'ProfileController@storeAddress')->name('profile.address.store');
        }
    );

Route::namespace('PWWEB\Core\Controllers')
    ->prefix('localisation')
    ->middleware(['web'])
    ->group(
        function () {
            Route::get('/', 'IndexController@index')->name('localisation.dashboard');
            Route::get('/change/{locale}', 'LanguageController@changeLocale')->name('localisation.switch');
            Route::get('/address/store', 'AddressController@store')->name('localisation.address.store');
        }
    );

Route::get(
    '/email/verify',
    function () {
        return view('auth.verify-email');
    }
)->middleware('auth')->name('verification.notice');

Route::get(
    '/email/verify/{id}/{hash}',
    function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('/home');
    }
)->middleware(['auth', 'signed'])->name('verification.verify');

Route::post(
    '/email/verification-notification',
    function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }
)->middleware(['auth', 'throttle:6,1'])->name('verification.send');
