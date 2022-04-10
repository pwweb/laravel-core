<?php

namespace PWWEB\Core\Helpers\Colour;

use PWWEB\Core\Contracts\Colour\Validator as ColourValidatorContract;

/**
 * PWWEB\Core\Helpers\Colours\Validator Class.
 *
 * Defining the colour validations.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class Validator implements ColourValidatorContract
{
    const PATTERN_HEX = '/^#(?:[0-9a-fA-F]{3}){1,2}$/';
    const PATTERN_RGB = '/^rgb\(\s*(0|[1-9]\d?|1\d\d?|2[0-4]\d|25[0-5])\s*,\s*(0|[1-9]\d?|1\d\d?|2[0-4]\d|25[0-5])\s*,\s*(0|[1-9]\d?|1\d\d?|2[0-4]\d|25[0-5])\s*\)$/';
    const PATTERN_RGBA = '/^rgba\(\s*(0|[1-9]\d?|1\d\d?|2[0-4]\d|25[0-5])\s*,\s*(0|[1-9]\d?|1\d\d?|2[0-4]\d|25[0-5])\s*,\s*(0|[1-9]\d?|1\d\d?|2[0-4]\d|25[0-5])\s*,\s*((0.[1-9])|[01])\s*\)$/';
    const PATTERN_HSL = '/^hsl\(\s*(0|[1-9]\d?|[12]\d\d|3[0-5]\d)\s*,\s*((0|[1-9]\d?|100)%)\s*,\s*((0|[1-9]\d?|100)%)\s*\)$/';
    const PATTERN_HSLA = '/^hsla\(\s*(0|[1-9]\d?|[12]\d\d|3[0-5]\d)\s*,\s*((0|[1-9]\d?|100)%)\s*,\s*((0|[1-9]\d?|100)%)\s*\,\s*((0.[1-9])|[01])\s*\)$/';

    /**
     * Check if the colour is valid HEX Colour.
     *
     * @param  string  $value  HEX colour value.
     * @return bool
     */
    public static function validateHex(string $value): bool
    {
        return 0 !== preg_match_all(self::PATTERN_HEX, $value);
    }

    /**
     * Check if the colour is valid RGB Colour.
     *
     * @param  string  $value  RGB colour value.
     * @return bool
     */
    public static function validateRgb(string $value): bool
    {
        return 0 !== preg_match_all(self::PATTERN_RGB, $value);
    }

    /**
     * Check if the colour is valid RGBA Colour.
     *
     * @param  string  $value  RGBA colour value.
     * @return bool
     */
    public static function validateRgba(string $value): bool
    {
        return 0 !== preg_match_all(self::PATTERN_RGBA, $value);
    }

    /**
     * Check if the colour is valid HSL Colour.
     *
     * @param  string  $value  HSL colour value.
     * @return bool
     */
    public static function validateHsl(string $value): bool
    {
        return 0 !== preg_match_all(self::PATTERN_HSL, $value);
    }

    /**
     * Check if the colour is valid HSLA Colour.
     *
     * @param  string  $value  HSLA colour value.
     * @return bool
     */
    public static function validateHsla(string $value): bool
    {
        return 0 !== preg_match_all(self::PATTERN_HSLA, $value);
    }
}
