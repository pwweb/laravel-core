<?php

namespace PWWEB\Core\Facades;

use Illuminate\Support\Facades\Facade;
use PWWEB\Core\Helpers\Application\Version;

/**
 * PWWEB\Core\Facades\ApplicationVersion.
 *
 * Facade for the application version helper.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class ApplicationVersion extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Version::class;
    }
}
