<?php

namespace PWWEB\Core\Facades;

/**
 * PWWEB\Core\Facades\Core.
 *
 * Facade for the package.
 *
 * @author    Frank Pillukeit <clients@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

use Illuminate\Support\Facades\Facade as BaseFacade;

class Core extends BaseFacade
{
    /**
     * Get the registered name of the component.
     *
     * @return string name of the facade
     */
    public static function getFacadeAccessor()
    {
        return 'core';
    }
}
