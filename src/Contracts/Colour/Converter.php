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
     * @see fromHexToRgb
     *
     * @param string $hex
     *
     * @return array
     */
    public static function hexToRgb(string $hex): array;

    /**
     * Convert a HEX color to an RGB array.
     *
     * @param string $hex
     *
     * @return array
     */
    public function fromHexToRgb(string $hex): array;

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
    public static function rgbToHex(int $red, int $green, int $blue): string;

    /**
     * Convert RGB values to a HEX color.
     *
     * @param int $red
     * @param int $green
     * @param int $blue
     *
     * @return string
     */
    public function fromRgbToHex(int $red, int $green, int $blue): string;

    /**
     * Convert an RGB color to an HSV array (alias).
     *
     * @see fromRgbToHsv
     *
     * @param int $red
     * @param int $green
     * @param int $blue
     *
     * @return array
     */
    public static function rgbToHsv(int $red, int $green, int $blue): array;

    /**
     * Convert an RGB color to an HSV array.
     *
     * @param int $red
     * @param int $green
     * @param int $blue
     *
     * @return array
     */
    public function fromRgbToHsv(int $red, int $green, int $blue): array;

    /**
     * Convert an HSV color to an RGB array (alias).
     *
     * @see fromHsvToRgb
     *
     * @param float $hue
     * @param float $saturation
     * @param float $value
     *
     * @return array
     */
    public static function hsvToRgb(float $hue, float $saturation, float $value): array;

    /**
     * Convert an HSV color to an RGB array.
     *
     * @param float $hue
     * @param float $saturation
     * @param float $value
     *
     * @return array
     */
    public function fromHsvToRgb(float $hue, float $saturation, float $value): array;

    /**
     * Convert a HEX color to an HSV array (alias).
     *
     * @see fromHexToHsv
     *
     * @param string $hex
     *
     * @return array
     */
    public static function hexToHsv(string $hex): array;

    /**
     * Convert a HEX color to an HSV array.
     *
     * @param string $hex
     *
     * @return array
     */
    public function fromHexToHsv(string $hex): array;

    /**
     * Convert an HSV to HEX color (alias).
     *
     * @see fromHsvToHex
     *
     * @param float $hue
     * @param float $saturation
     * @param float $value
     *
     * @return string
     */
    public static function hsvToHex(float $hue, float $saturation, float $value): string;

    /**
     * Convert an HSV to HEX color.
     *
     * @param float $hue
     * @param float $saturation
     * @param float $value
     *
     * @return string
     */
    public function fromHsvToHex(float $hue, float $saturation, float $value): string;
}
