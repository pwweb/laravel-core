<?php

namespace PWWEB\Core;

use Carbon\Carbon;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

/**
 * PWWEB\Core.
 *
 * Core Service Provider.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class CoreServiceProvider extends ServiceProvider
{
    /**
     * Collection of blade directives.
     *
     * @var \PWWEB\Core\Blade\Directives[]
     */
    private $directives = [];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/resources/config/core.php',
            'pwweb.core'
        );

        // Register controllers.
        $this->app->make(\PWWEB\Core\Controllers\PersonController::class);
        $this->app->make(\PWWEB\Core\Controllers\ProfileController::class);
        $this->app->make(\PWWEB\Core\Controllers\UserController::class);
        $this->app->make(\PWWEB\Core\Controllers\Menu\EnvironmentController::class);
        $this->app->make(\PWWEB\Core\Controllers\Menu\ItemController::class);

        // Register views.
        $this->loadViewsFrom(__DIR__.'/resources/views', 'core');

        // Register listeners.
        Event::listen(
            'Illuminate\Auth\Events\PasswordReset',
            \PWWEB\Core\Listeners\ResetPassword::class,
        );

        Carbon::setToStringFormat('Y-m-d');

        // Register helpers.
        foreach (glob(__DIR__.'/Helpers/*.php') as $file) {
            require_once $file;
        }

        parent::register();

        $this->app->bind(Contracts\Colour::class, Helpers\Colour::class);
        $this->app->bind(Contracts\Colour\Converter::class, Helpers\ColorConverter::class);
    }

    /**
     * Boostrap the services of the package.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/resources/routes/web.php');

        if (true === function_exists('config_path')) {
            $timestamp = date('Y_m_d_His', mktime(0, 0, 0, 1, 1, 2000));

            $this->publishes(
                [
                    __DIR__.'/resources/config/core.php' => config_path('pwweb/core.php'),
                ],
                'pwweb.core.config'
            );

            $this->publishes(
                [
                    __DIR__.'/Database/Migrations/CreateMenuEnvironmentsTable.php' => $this->app->databasePath()."/migrations/{$timestamp}_create_menu_environments_table.php",
                    __DIR__.'/Database/Migrations/CreateMenuItemsTable.php' => $this->app->databasePath()."/migrations/{$timestamp}_create_menu_items_table.php",
                    __DIR__.'/Database/Migrations/CreateUsersTable.php' => $this->app->databasePath()."/migrations/{$timestamp}_create_users_table.php",
                    __DIR__.'/Database/Migrations/CreatePersonsTable.php' => $this->app->databasePath()."/migrations/{$timestamp}_create_persons_table.php",
                    __DIR__.'/Database/Migrations/UpdateUsersTable.php' => $this->app->databasePath()."/migrations/{$timestamp}_update_users_table.php",
                    __DIR__.'/Database/Migrations/CreateUserPasswordHistoriesTable.php' => $this->app->databasePath()."/migrations/{$timestamp}_create_user_password_histories_table.php",
                ],
                'pwweb.core.migrations'
            );

            $this->publishes(
                [
                    __DIR__.'/resources/lang' => resource_path('lang/vendor/pwweb'),
                ],
                'pwweb.core.language'
            );

            $this->publishes(
                [
                    __DIR__.'/resources/views' => base_path('resources/views/vendor/core'),
                ],
                'pwweb.core.views'
            );
        }//end if

        $this->loadTranslationsFrom(realpath(__DIR__.'/resources/lang'), 'pwweb');

        $loader = AliasLoader::getInstance();
        $loader->alias('Core', \PWWEB\Core\Facades\Core::class);

        $this->registerDirectives();
    }

    public function provides(): array
    {
        return [
            Contracts\Colour::class,
            Contracts\Colour\Converter::class,
        ];
    }

    /**
     * Register Blade directives for use.
     *
     * @return void
     */
    public function registerDirectives()
    {
        $this->directives[] = \App::make(Blade\Directives\Date::class);
        $this->directives[] = \App::make(Blade\Directives\IsNull::class);
        $this->directives[] = \App::make(Blade\Directives\IsNotNull::class);
        $this->directives[] = \App::make(Blade\Directives\Menu::class);
    }
}
