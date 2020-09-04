<?php

namespace PWWEB\Core\Contracts\Colour;

/**
 * PWWEB\Core\Contracts\Colour\Validator Contract.
 *
 * Defining the contract for colour validation.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
interface Validator
{
    /**
     * Check if the color is valid HEX Color.
     *
     * @param string $hex
     *
     * @return bool
     */
    public static function validateHex(string $hex): bool;

    /**
     * Check if the color is valid RGB Color.
     *
     * @param string $value
     *
     * @return bool
     */
    public static function validateRgb(string $value): bool;

    /**
     * Check if the color is valid RGBA Color.
     *
     * @param string $value
     *
     * @return bool
     */
    public static function validateRgba(string $value): bool;

    /**
     * Check if the color is valid HSL Color.
     *
     * @param string $value
     *
     * @return bool
     */
    public static function validateHsl(string $value): bool;

    /**
     * Check if the color is valid HSLA Color.
     *
     * @param string $value
     *
     * @return bool
     */
    public static function validateHsla(string $value): bool;
}
