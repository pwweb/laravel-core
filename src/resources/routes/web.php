<?php

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
