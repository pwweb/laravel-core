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
     * @param string $hex HEX value of the colour.
     *
     * @return array
     *
     * @see fromHexToRgb
     */
    public static function hexToRgb(string $hex): array
    {
        return (new static)->fromHexToRgb($hex);
    }

    /**
     * Convert a HEX color to an RGB array.
     *
     * @param string $hex HEX value of the colour.
     *
     * @return array
     */
    public function fromHexToRgb(string $hex): array
    {
        $value = str_replace('#', '', $hex);

        return array_map(
            'hexdec',
            true === (6 === strlen($value)) ? [
                substr($value, 0, 2),
                // Red.
                substr($value, 2, 2),
                // Green.
                substr($value, 4, 2),
                // Blue.
            ] : [
                str_repeat(substr($value, 0, 1), 2),
                // Red.
                str_repeat(substr($value, 1, 1), 2),
                // Green.
                str_repeat(substr($value, 2, 1), 2),
                // Blue.
            ]
        );
    }

    /**
     * Convert RGB values to a HEX color (alias).
     *
     * @param int $red   Red value for the colour.
     * @param int $green Green value for the colour.
     * @param int $blue  Blue value for the colour.
     *
     * @return string
     *
     * @see fromRgbToHex
     */
    public static function rgbToHex(int $red, int $green, int $blue): string
    {
        return (new static)->fromRgbToHex($red, $green, $blue);
    }

    /**
     * Convert RGB values to a HEX color.
     *
     * @param int $red   Red value for the colour.
     * @param int $green Green value for the colour.
     * @param int $blue  Blue value for the colour.
     *
     * @return string
     */
    public function fromRgbToHex(int $red, int $green, int $blue): string
    {
        return '#'.implode(
            '',
            array_map(
                function ($value) {
                    return str_pad(dechex($value), 2, '0', STR_PAD_LEFT);
                },
                [$red, $green, $blue]
            )
        );
    }
}
