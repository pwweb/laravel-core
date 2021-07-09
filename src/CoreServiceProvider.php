<?php

namespace PWWEB\Core;

use Carbon\Carbon;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use PWWEB\Core\Interfaces\Address\TypeRepositoryInterface;
use PWWEB\Core\Interfaces\AddressRepositoryInterface;
use PWWEB\Core\Interfaces\BaseRepositoryInterface;
use PWWEB\Core\Interfaces\CountryRepositoryInterface;
use PWWEB\Core\Interfaces\CurrencyRepositoryInterface;
use PWWEB\Core\Interfaces\ExchangeRateRepositoryInterface;
use PWWEB\Core\Interfaces\LanguageRepositoryInterface;
use PWWEB\Core\Interfaces\MenuRepositoryInterface;
use PWWEB\Core\Interfaces\PermissionRepositoryInterface;
use PWWEB\Core\Interfaces\PersonRepositoryInterface;
use PWWEB\Core\Interfaces\RoleRepositoryInterface;
use PWWEB\Core\Interfaces\Tax\LocationRepositoryInterface;
use PWWEB\Core\Interfaces\Tax\RateRepositoryInterface;
use PWWEB\Core\Interfaces\User\Password\HistoryRepositoryInterface;
use PWWEB\Core\Interfaces\UserRepositoryInterface;
use PWWEB\Core\Repositories\Address\TypeRepository;
use PWWEB\Core\Repositories\AddressRepository;
use PWWEB\Core\Repositories\BaseRepository;
use PWWEB\Core\Repositories\CountryRepository;
use PWWEB\Core\Repositories\CurrencyRepository;
use PWWEB\Core\Repositories\ExchangeRateRepository;
use PWWEB\Core\Repositories\LanguageRepository;
use PWWEB\Core\Repositories\MenuRepository;
use PWWEB\Core\Repositories\PermissionRepository;
use PWWEB\Core\Repositories\PersonRepository;
use PWWEB\Core\Repositories\RoleRepository;
use PWWEB\Core\Repositories\Tax\LocationRepository;
use PWWEB\Core\Repositories\Tax\RateRepository;
use PWWEB\Core\Repositories\User\Password\HistoryRepository;
use PWWEB\Core\Repositories\UserRepository;

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
     * @var array
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
        $this->app->make('PWWEB\Core\Controllers\IndexController');

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
            include_once $file;
        }

        parent::register();

        $this->app->bind(Contracts\Colour::class, Helpers\Colour::class);
        $this->app->bind(Contracts\Colour\Converter::class, Helpers\Colour\Converter::class);

        // Bind the interfaces:
        $this->app->bind(TypeRepositoryInterface::class, TypeRepository::class);
        $this->app->bind(LocationRepositoryInterface::class, LocationRepository::class);
        $this->app->bind(RateRepositoryInterface::class, RateRepository::class);
        $this->app->bind(HistoryRepositoryInterface::class, HistoryRepository::class);
        $this->app->bind(AddressRepositoryInterface::class, AddressRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(CountryRepositoryInterface::class, CountryRepository::class);
        $this->app->bind(CurrencyRepositoryInterface::class, CurrencyRepository::class);
        $this->app->bind(ExchangeRateRepositoryInterface::class, ExchangeRateRepository::class);
        $this->app->bind(LanguageRepositoryInterface::class, LanguageRepository::class);
        $this->app->bind(MenuRepositoryInterface::class, MenuRepository::class);
        $this->app->bind(PersonRepositoryInterface::class, PersonRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Boostrap the services of the package.
     *
     * @param LocalisationRegistrar $localisationLoader Loader the localisation registrar
     * @param Router                $router             laravel router object for file handling
     *
     * @return void
     */
    public function boot(LocalisationRegistrar $localisationLoader, Router $router)
    {
        $this->registerRoutes();

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
                    __DIR__.'/Database/Migrations/CreateMenusTable.php' => $this->app->databasePath()."/migrations/{$timestamp}_create_menus_table.php",
                    __DIR__.'/Database/Migrations/CreateLocalisationTable.php' => $this->app->databasePath()."/migrations/{$timestamp}_create_localisation_tables.php",
                    __DIR__.'/Database/Migrations/CreateUsersTable.php' => $this->app->databasePath()."/migrations/{$timestamp}_create_users_table.php",
                    __DIR__.'/Database/Migrations/CreatePersonsTable.php' => $this->app->databasePath()."/migrations/{$timestamp}_create_persons_table.php",
                    __DIR__.'/Database/Migrations/UpdateUsersTable.php' => $this->app->databasePath()."/migrations/{$timestamp}_update_users_table.php",
                    __DIR__.'/Database/Migrations/CreateUserPasswordHistoriesTable.php' => $this->app->databasePath()."/migrations/{$timestamp}_create_user_password_histories_table.php",
                    __DIR__.'/Database/Migrations/UpdateTaxRatesTable.php' => $this->app->databasePath()."/migrations/{$timestamp}_update_tax_rates_table.php",
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

        $this->commands(
            [
                Commands\CacheReset::class,
            ]
        );

        $this->loadTranslationsFrom(realpath(__DIR__.'/resources/lang'), 'pwweb');

        $this->registerModelBindings();

        $localisationLoader->clearClassLanguages();
        $localisationLoader->registerLanguages();

        $this->app->bind('localisation', \PWWEB\Core\Localisation::class);

        $loader = AliasLoader::getInstance();
        $loader->alias('Core', \PWWEB\Core\Facades\Core::class);
        $loader->alias('Localisation', \PWWEB\Core\Facades\Localisation::class);
        $loader->alias('ApplicationVersion', \PWWEB\Core\Facades\ApplicationVersion::class);

        $this->app->singleton(
            LocalisationRegistrar::class,
            function ($app) use ($localisationLoader) {
                return $localisationLoader;
            }
        );

        // Bind an instance of the language repository to the container.
        $languageRepo = new \PWWEB\Core\Repositories\LanguageRepository($this->app);
        $this->app->instance(\PWWEB\Core\Repositories\LanguageRepository::class, $languageRepo);

        // Register the local middleware with the application.
        $router->middlewareGroup('localisation', [\PWWEB\Core\Middleware\Locale::class]);

        $this->registerDirectives();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
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

    /**
     * Registers model bindings.
     *
     * @return void
     */
    protected function registerModelBindings()
    {
        $config = config('pwweb.core.models');

        if (false === $config) {
            return;
        }

        $this->app->bind(AddressContract::class, $config['address']);
        $this->app->bind(AddressTypeContract::class, $config['address_type']);
        $this->app->bind(CountryContract::class, $config['country']);
        $this->app->bind(CurrencyContract::class, $config['currency']);
        $this->app->bind(ExchangeRateContract::class, $config['exchange_rate']);
        $this->app->bind(LanguageContract::class, $config['language']);
    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        if (Core::$registersRoutes) {
            Route::group([
                'prefix' => config('pwweb.core.path'),
                'namespace' => 'Pwweb\Core\Http\Controllers',
                'as' => 'pwweb.core.',
            ], function () {
                $this->loadRoutesFrom(__DIR__.'/resources/routes/web.php');
            });
        }
    }
}
