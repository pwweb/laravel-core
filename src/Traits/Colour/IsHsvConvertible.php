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
     * @param int $red   Red value for the colour.
     * @param int $green Green value for the colour.
     * @param int $blue  Blue value for the colour.
     *
     * @return array
     *
     * @see fromRgbToHsv
     */
    public static function rgbToHsv(int $red, int $green, int $blue): array
    {
        return (new static)->fromRgbToHsv($red, $green, $blue);
    }

    /**
     * Convert an RGB color to an HSV array.
     *
     * @param int $red   Red value for the colour.
     * @param int $green Green value for the colour.
     * @param int $blue  Blue value for the colour.
     *
     * @return array
     */
    public function fromRgbToHsv(int $red, int $green, int $blue): array
    {
        $red = ($red / 255);
        $green = ($green / 255);
        $blue = ($blue / 255);
        $maxRGB = max($red, $green, $blue);
        $minRGB = min($red, $green, $blue);

        $hue = 0;
        $saturation = 0;
        $value = (100 * $maxRGB);
        $chroma = ($maxRGB - $minRGB);

        if (0 !== $chroma) {
            $saturation = (100 * ($chroma / $maxRGB));
            $hue = ($this->recalculateHue($red, $green, $blue, $minRGB, $chroma) * 60);
        }

        return array_map(
            function ($value) {
                return round($value, 2);
            },
            [$hue, $saturation, $value]
        );
    }

    /**
     * Convert an HSV color to an RGB array (alias).
     *
     * @param float $hue        Hue of the colour.
     * @param float $saturation Saturation of the colour.
     * @param float $value      Value of the colour.
     *
     * @return array
     *
     * @see fromHsvToRgb
     */
    public static function hsvToRgb(float $hue, float $saturation, float $value): array
    {
        return (new static)->fromHsvToRgb($hue, $saturation, $value);
    }

    /**
     * Convert an HSV color to an RGB array.
     *
     * @param float $hue        Hue of the colour.
     * @param float $saturation Saturation of the colour.
     * @param float $value      Value of the colour.
     *
     * @return array
     */
    public function fromHsvToRgb(float $hue, float $saturation, float $value): array
    {
        // Lightness: 0.0 - 1.0.
        $lightness = ($this->sanitizeHsvValue($value, 0, 100) / 100.0);
        // Chroma:    0.0 - 1.0.
        $chroma = ($lightness * ($this->sanitizeHsvValue($saturation, 0, 100) / 100.0));

        return array_map(
            function ($color) use ($lightness, $chroma) {
                return (int) round(($color + ($lightness - $chroma)) * 255);
            },
            $this->calculateRgbWithHueAndChroma($hue, $chroma)
        );
    }

    /**
     * Recalculate the Hue.
     *
     * @param int   $red    Red value for the colour.
     * @param int   $green  Green value for the colour.
     * @param int   $blue   Blue value for the colour.
     * @param float $minRGB Minimum RGB.
     * @param float $chroma Chroma of the colour.
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
     * @param float $hue    Hue of the colour.
     * @param float $chroma Chroma of the colour.
     *
     * @return array
     */
    protected function calculateRgbWithHueAndChroma(float $hue, float $chroma): array
    {
        $hPrime = ($this->sanitizeHsvValue($hue, 0, 360) / 60.0);
        $xPrime = $this->calculateXPrime($hPrime, $chroma);
        $colors = $this->getColorsRange($chroma, $xPrime);
        $index = (int) floor($hPrime);

        if (true === array_key_exists($index, $colors)) {
            return $colors[$index];
        }

        return [0.0, 0.0, 0.0];
    }

    /**
     * Calculate X-Prime.
     *
     * @param float $hPrime H Prime of the colour.
     * @param float $chroma Chroma of the colour.
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
     * @param float $value HSV value of the colour.
     * @param float $min   Minimum.
     * @param float $max   Maximum.
     *
     * @return int
     */
    protected function sanitizeHsvValue(float $value, float $min, float $max): int
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
     * @param float $chroma Chroma of the colour.
     * @param float $xPrime X Prime of the colour.
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
