<?php

use PWWEB\Core\Controllers\Address\TypeController;
use PWWEB\Core\Controllers\AddressController;
use PWWEB\Core\Controllers\CountryController;
use PWWEB\Core\Controllers\CurrencyController;
use PWWEB\Core\Controllers\LanguageController;
use PWWEB\Core\Controllers\MenuController;
use PWWEB\Core\Controllers\PersonController;
use PWWEB\Core\Controllers\Tax\LocationController;
use PWWEB\Core\Controllers\Tax\RateController;
use PWWEB\Core\Controllers\UserController;

Route::name('core.')
    ->middleware(['web', 'auth', 'localisation'])
    ->group(
        function () {
            Route::resource('persons', PersonController::class);
            Route::resource('users', UserController::class);
            Route::resource('menus', MenuController::class);
            Route::resource('countries', CountryController::class);
            Route::resource('currencies', CurrencyController::class);
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
