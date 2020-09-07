<?php

namespace PWWEB\Core\Helpers\Colour;

use PWWEB\Core\Contracts\Colour\Converter as ColorConverterContract;
use PWWEB\Core\Traits\Colour\IsHexConvertible;
use PWWEB\Core\Traits\Colour\IsHsvConvertible;

/**
 * PWWEB\Core\Helpers\Colours\Converter Class.
 *
 * Defining the colour functionalities.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class Converter implements ColorConverterContract
{
    use IsHexConvertible;
    use IsHsvConvertible;

    /**
     * Convert a HEX color to an HSV array (alias).
     *
     * @see fromHexToHsv
     *
     * @param string $hex
     *
     * @return array
     */
    public static function hexToHsv(string $hex): array
    {
        return (new static)->fromHexToHsv($hex);
    }

    /**
     * Convert a HEX color to an HSV array.
     *
     * @param string $hex
     *
     * @return array
     */
    public function fromHexToHsv(string $hex): array
    {
        [$red, $green, $blue] = $this->fromHexToRgb($hex);

        return $this->fromRgbToHsv($red, $green, $blue);
    }

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
    public static function hsvToHex(float $hue, float $saturation, float $value): string
    {
        return (new static)->fromHsvToHex($hue, $saturation, $value);
    }

    /**
     * Convert an HSV to HEX color.
     *
     * @param float $hue
     * @param float $saturation
     * @param float $value
     *
     * @return string
     */
    public function fromHsvToHex(float $hue, float $saturation, float $value): string
    {
        [$red, $green, $blue] = $this->fromHsvToRgb($hue, $saturation, $value);

        return $this->fromRgbToHex($red, $green, $blue);
    }
}
