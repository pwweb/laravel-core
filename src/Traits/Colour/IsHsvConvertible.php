<?php

namespace PWWEB\Core\Traits\Colour;

/**
 * PWWEB\Core\Traits\Colours\IsHsvConvertible Trait.
 *
 * Defines the conversions between HSV and RGB.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
trait IsHsvConvertible
{
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
    public static function rgbToHsv(int $red, int $green, int $blue): array
    {
        return (new static)->fromRgbToHsv($red, $green, $blue);
    }

    /**
     * Convert an RGB color to an HSV array.
     *
     * @param int $red
     * @param int $green
     * @param int $blue
     *
     * @return array
     */
    public function fromRgbToHsv(int $red, int $green, int $blue): array
    {
        $red = $red / 255;
        $green = $green / 255;
        $blue = $blue / 255;
        $maxRGB = max($red, $green, $blue);
        $minRGB = min($red, $green, $blue);

        $hue = 0;
        $saturation = 0;
        $value = 100 * $maxRGB;
        $chroma = $maxRGB - $minRGB;

        if (0 != $chroma) {
            $saturation = 100 * ($chroma / $maxRGB);
            $hue = $this->recalculateHue($red, $green, $blue, $minRGB, $chroma) * 60;
        }

        return array_map(function ($value) {
            return round($value, 2);
        }, [$hue, $saturation, $value]);
    }

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
    public static function hsvToRgb(float $hue, float $saturation, float $value): array
    {
        return (new static)->fromHsvToRgb($hue, $saturation, $value);
    }

    /**
     * Convert an HSV color to an RGB array.
     *
     * @param float $hue
     * @param float $saturation
     * @param float $value
     *
     * @return array
     */
    public function fromHsvToRgb(float $hue, float $saturation, float $value): array
    {
        // Lightness: 0.0 - 1.0.
        $lightness = $this->sanitizeHsvValue($value, 0, 100) / 100.0;
        // Chroma:    0.0 - 1.0.
        $chroma = $lightness * ($this->sanitizeHsvValue($saturation, 0, 100) / 100.0);

        return array_map(function ($color) use ($lightness, $chroma) {
            return (int) round(($color + ($lightness - $chroma)) * 255);
        }, $this->calculateRgbWithHueAndChroma($hue, $chroma));
    }

    /**
     * Recalculate the Hue.
     *
     * @param int $red
     * @param int $green
     * @param int $blue
     * @param float $minRGB
     * @param float $chroma
     *
     * @return float
     */
    protected function recalculateHue(int $red, int $green, int $blue, float $minRGB, float $chroma): float
    {
        switch ($minRGB) {
            case $red:
                return 3 - (($green - $blue) / $chroma);

            case $blue:
                return 1 - (($red - $green) / $chroma);

            case $green:
            default:
                return 5 - (($blue - $red) / $chroma);
        }
    }

    /**
     * Calculate RGB with hue and chroma.
     *
     * @param float $hue
     * @param float $chroma
     *
     * @return array
     */
    protected function calculateRgbWithHueAndChroma(float $hue, float $chroma): array
    {
        $hPrime = $this->sanitizeHsvValue($hue, 0, 360) / 60.0;
        $xPrime = $this->calculateXPrime($hPrime, $chroma);
        $colors = $this->getColorsRange($chroma, $xPrime);
        $index = (int) floor($hPrime);

        return array_key_exists($index, $colors)
            ? $colors[$index]
            : [0.0, 0.0, 0.0];
    }

    /**
     * Calculate X-Prime.
     *
     * @param float $hPrime
     * @param float $chroma
     *
     * @return float
     */
    protected function calculateXPrime(float $hPrime, float $chroma): float
    {
        while ($hPrime >= 2.0) {
            $hPrime -= 2.0;
        }

        return $chroma * (1 - abs($hPrime - 1));
    }

    /**
     * Sanitize HSV value.
     *
     * @param int $value
     * @param int $min
     * @param int $max
     *
     * @return int
     */
    protected function sanitizeHsvValue(int $value, int $min, int $max): int
    {
        if ($value < $min) {
            return $min;
        }
        if ($value > $max) {
            return $max;
        }

        return $value;
    }

    /**
     * Get the colors range.
     *
     * @param float $chroma
     * @param float $xPrime
     *
     * @return array
     */
    protected function getColorsRange(float $chroma, float $xPrime): array
    {
        return [
            0 => [$chroma, $xPrime, 0.0],
            1 => [$xPrime, $chroma, 0.0],
            2 => [0.0, $chroma, $xPrime],
            3 => [0.0, $xPrime, $chroma],
            4 => [$xPrime, 0.0, $chroma],
            5 => [$chroma, 0.0, $xPrime],
        ];
    }
}