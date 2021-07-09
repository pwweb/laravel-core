<?php

/**
 * PWWEB\Core.
 *
 * Core Master Class.
 *
 * @author    Frank Pillukeit <clients@pw-websolutions.com>
 * @author    Richard Browne <richard@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace PWWEB\Core;

class Core
{
    /**
     * Indicates if Core routes will be registered.
     *
     * @var bool
     */
    public static $registersRoutes = true;

    /**
     * Configure Core to not register its routes.
     *
     * @return static
     */
    public static function ignoreRoutes()
    {
        static::$registersRoutes = false;

        return new static;
    }
}
