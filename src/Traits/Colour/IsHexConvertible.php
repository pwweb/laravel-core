<?php

namespace PWWEB\Core\Traits\Colour;

/**
 * PWWEB\Core\Traits\Colours\IsHexConvertible Trait.
 *
 * Defines the conversions between HEX and RGB.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
trait IsHexConvertible
{
    /**
     * Convert a HEX color to an RGB array (alias).
     *
     * @see fromHexToRgb
     *
     * @param string $hex
     *
     * @return array
     */
    public static function hexToRgb(string $hex): array
    {
        return (new static)->fromHexToRgb($hex);
    }

    /**
     * Convert a HEX color to an RGB array.
     *
     * @param string $hex
     *
     * @return array
     */
    public function fromHexToRgb(string $hex): array
    {
        $value = str_replace('#', '', $hex);

        return array_map('hexdec', 6 === strlen($value) ? [
            substr($value, 0, 2), // Red.
            substr($value, 2, 2), // Green.
            substr($value, 4, 2), // Blue.
        ] : [
            str_repeat(substr($value, 0, 1), 2), // Red.
            str_repeat(substr($value, 1, 1), 2), // Green.
            str_repeat(substr($value, 2, 1), 2), // Blue.
        ]);
    }

    /**
     * Convert RGB values to a HEX color (alias).
     *
     * @see fromRgbToHex
     *
     * @param int $red
     * @param int $green
     * @param int $blue
     *
     * @return string
     */
    public static function rgbToHex(int $red, int $green, int $blue): string
    {
        return (new static)->fromRgbToHex($red, $green, $blue);
    }

    /**
     * Convert RGB values to a HEX color.
     *
     * @param int $red
     * @param int $green
     * @param int $blue
     *
     * @return string
     */
    public function fromRgbToHex(int $red, int $green, int $blue): string
    {
        return '#'.implode('', array_map(function ($value) {
            return str_pad(dechex($value), 2, '0', STR_PAD_LEFT);
        }, [$red, $green, $blue]));
    }
}
