<?php

namespace PWWEB\Core\Helpers\Colour;

use PWWEB\Core\Contracts\Colour\Validator as ColorValidatorContract;

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
class Validator implements ColorValidatorContract
{
    const PATTERN_HEX = '/^#(?:[0-9a-fA-F]{3}){1,2}$/';
    const PATTERN_RGB = '/^rgb\(\s*(0|[1-9]\d?|1\d\d?|2[0-4]\d|25[0-5])\s*,\s*(0|[1-9]\d?|1\d\d?|2[0-4]\d|25[0-5])\s*,\s*(0|[1-9]\d?|1\d\d?|2[0-4]\d|25[0-5])\s*\)$/';
    const PATTERN_RGBA = '/^rgba\(\s*(0|[1-9]\d?|1\d\d?|2[0-4]\d|25[0-5])\s*,\s*(0|[1-9]\d?|1\d\d?|2[0-4]\d|25[0-5])\s*,\s*(0|[1-9]\d?|1\d\d?|2[0-4]\d|25[0-5])\s*,\s*((0.[1-9])|[01])\s*\)$/';
    const PATTERN_HSL = '/^hsl\(\s*(0|[1-9]\d?|[12]\d\d|3[0-5]\d)\s*,\s*((0|[1-9]\d?|100)%)\s*,\s*((0|[1-9]\d?|100)%)\s*\)$/';
    const PATTERN_HSLA = '/^hsla\(\s*(0|[1-9]\d?|[12]\d\d|3[0-5]\d)\s*,\s*((0|[1-9]\d?|100)%)\s*,\s*((0|[1-9]\d?|100)%)\s*\,\s*((0.[1-9])|[01])\s*\)$/';

    /**
     * Check if the color is valid HEX Color.
     *
     * @param string $value
     *
     * @return bool
     */
    public static function validateHex(string $value): bool
    {
        return 0 !== preg_match_all(self::PATTERN_HEX, $value);
    }

    /**
     * Check if the color is valid RGB Color.
     *
     * @param string $value
     *
     * @return bool
     */
    public static function validateRgb(string $value): bool
    {
        return 0 !== preg_match_all(self::PATTERN_RGB, $value);
    }

    /**
     * Check if the color is valid RGBA Color.
     *
     * @param string $value
     *
     * @return bool
     */
    public static function validateRgba(string $value): bool
    {
        return 0 !== preg_match_all(self::PATTERN_RGBA, $value);
    }

    /**
     * Check if the color is valid HSL Color.
     *
     * @param string $value
     *
     * @return bool
     */
    public static function validateHsl(string $value): bool
    {
        return 0 !== preg_match_all(self::PATTERN_HSL, $value);
    }

    /**
     * Check if the color is valid HSLA Color.
     *
     * @param string $value
     *
     * @return bool
     */
    public static function validateHsla(string $value): bool
    {
        return 0 !== preg_match_all(self::PATTERN_HSLA, $value);
    }
}
