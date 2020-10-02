<?php

use PWWEB\Core\Controllers\Menu\EnvironmentController;
use PWWEB\Core\Controllers\Menu\ItemController;
use PWWEB\Core\Controllers\PersonController;
use PWWEB\Core\Controllers\UserController;

Route::name('core.')
    ->middleware(['web', 'auth', 'localisation'])
    ->group(
        function () {
            Route::resource('persons', PersonController::class);
            Route::resource('users', UserController::class);
            Route::prefix('menu')
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
            Route::get('/address/show/{address}', '\PWWEB\Localisation\Controllers\AddressController@show')->name('profile.address.show');
            Route::get('/address/create', 'ProfileController@createAddress')->name('profile.address.create');
            Route::post('/address/store', 'ProfileController@storeAddress')->name('profile.address.store');
        }
    );
