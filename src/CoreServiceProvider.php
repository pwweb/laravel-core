<?php

namespace PWWEB\Core;

/**
 * PWWEB\Core.
 *
 * Core Service Provider.
 *
 * @author    Frank Pillukeit <clients@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Nothing to do for the current release.
    }

    /**
     * Boostrap the services of the package.
     *
     * @return void
     */
    public function boot()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('Core', \PWWEB\Core\Facades\Core::class);
    }
}
