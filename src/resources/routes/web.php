<?php

use PWWEB\Core\Controllers\EnvironmentController;
use PWWEB\Core\Controllers\ItemController;
use PWWEB\Core\Controllers\PersonController;
use PWWEB\Core\Controllers\UserController;

Route::namespace('PWWEB\Core\Controllers')
    ->name('core.')
    ->middleware(['web', 'auth'])
    ->group(
        function () {
            Route::resource('persons', PersonController::class);
            Route::resource('users', UserController::class);
            Route::namespace('Menu')
                ->prefix('menu')
                ->name('menu.')
                ->group(
                    function () {
                        Route::resource('environments', EnvironmentController::class);
                        Route::resource('items', ItemController::class);
                    }
                );
        }
    );

Route::namespace('\PWWEB\Core\Controllers')
    ->name('system.')
    ->prefix('profile')
    ->middleware(['web', 'auth'])
    ->group(
        function () {
            Route::get('/', 'ProfileController@index')->name('profile.index');
            Route::get('/edit', 'ProfileController@edit')->name('profile.edit');
            Route::get('/reverify', 'ProfileController@reverify')->name('profile.reverify');
            Route::get('/password', 'ProfileController@password')->name('profile.password');
            Route::post('/store', 'ProfileController@store')->name('profile.store');
            Route::patch('/update', 'ProfileController@update')->name('profile.update');
            Route::patch('/updatePassword', 'ProfileController@updatePassword')->name('profile.password.update');
            Route::patch('/avatar', 'ProfileController@updateAvatar')->name('profile.update.avatar');
            Route::get('/address/show/{address}', '\PWWEB\Localisation\Controllers\AddressController@show')->name('profile.address.show');
            Route::get('/address/create', '\PWWEB\Localisation\Controllers\AddressController@create')->name('profile.address.create');
            Route::post('/address/store', '\PWWEB\Localisation\Controllers\AddressController@store')->name('profile.address.store');
        }
    );
