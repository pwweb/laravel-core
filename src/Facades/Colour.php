<?php

namespace PWWEB\Core\Facades;

use Illuminate\Support\Facades\Facade;
use PWWEB\Core\Contracts\Colour as ColourContract;

/**
  * PWWEB\Core\Facades\Colour.
  *
  * Facade for the package component colour.
  *
  * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
  * @author    Richard Browne <richard.browne@pw-websolutions.com>
  * @copyright 2020 pw-websolutions.com
  * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
  */
class Colour extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return ColourContract::class;
    }
}
