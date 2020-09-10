<?php

namespace PWWEB\Core\Contracts\Colour;

/**
 * PWWEB\Core\Contracts\Colour\Converter Contract.
 *
 * Defining the contract for colour converters.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
interface Converter
{
    /**
     * Convert a HEX color to an RGB array (alias).
     *
     * @param string $hex Hex value of the colour.
     *
     * @return array
     *
     * @see fromHexToRgb
     */
    public static function hexToRgb(string $hex): array;

    /**
     * Convert a HEX color to an RGB array.
     *
     * @param string $hex Hex value of the colour.
     *
     * @return array
     */
    public function fromHexToRgb(string $hex): array;

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
    public static function rgbToHex(int $red, int $green, int $blue): string;

    /**
     * Convert RGB values to a HEX color.
     *
     * @param int $red   Red value for the colour.
     * @param int $green Green value for the colour.
     * @param int $blue  Blue value for the colour.
     *
     * @return string
     */
    public function fromRgbToHex(int $red, int $green, int $blue): string;

    /**
     * Convert an RGB color to an HSV array (alias).
     *
     * @param int $red   Red value for the colour.
     * @param int $green Green value for the colour.
     * @param int $blue  Blue value for the colour.
     *
     * @return array
     *
     * @see fromRgbToHsv
     */
    public static function rgbToHsv(int $red, int $green, int $blue): array;

    /**
     * Convert an RGB color to an HSV array.
     *
     * @param int $red   Red value for the colour.
     * @param int $green Green value for the colour.
     * @param int $blue  Blue value for the colour.
     *
     * @return array
     */
    public function fromRgbToHsv(int $red, int $green, int $blue): array;

    /**
     * Convert an HSV color to an RGB array (alias).
     *
     * @param float $hue        Hue of the colour.
     * @param float $saturation Saturation of the colour.
     * @param float $value      Colour value.
     *
     * @return array
     *
     * @see fromHsvToRgb
     */
    public static function hsvToRgb(float $hue, float $saturation, float $value): array;

    /**
     * Convert an HSV color to an RGB array.
     *
     * @param float $hue        Hue of the colour.
     * @param float $saturation Saturation of the colour.
     * @param float $value      Colour value.
     *
     * @return array
     */
    public function fromHsvToRgb(float $hue, float $saturation, float $value): array;

    /**
     * Convert a HEX color to an HSV array (alias).
     *
     * @param string $hex Hex value of the colour.
     *
     * @return array
     *
     * @see fromHexToHsv
     */
    public static function hexToHsv(string $hex): array;

    /**
     * Convert a HEX color to an HSV array.
     *
     * @param string $hex Hex value of the colour.
     *
     * @return array
     */
    public function fromHexToHsv(string $hex): array;

    /**
     * Convert an HSV to HEX color (alias).
     *
     * @param float $hue        Hue of the colour.
     * @param float $saturation Saturation of the colour.
     * @param float $value      Colour value.
     *
     * @return string
     *
     * @see fromHsvToHex
     */
    public static function hsvToHex(float $hue, float $saturation, float $value): string;

    /**
     * Convert an HSV to HEX color.
     *
     * @param float $hue        Hue of the colour.
     * @param float $saturation Saturation of the colour.
     * @param float $value      Colour value.
     *
     * @return string
     */
    public function fromHsvToHex(float $hue, float $saturation, float $value): string;
}
