<?php

Route::namespace('PWWEB\Core\Controllers')
    ->name('core.')
    // ->middleware('auth')
    ->group(
        function () {
            Route::resource('persons', PersonController::class);
            Route::resource('users', UserController::class);
        }
    );
