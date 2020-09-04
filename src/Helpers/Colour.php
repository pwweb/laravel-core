<?php

namespace PWWEB\Core\Helpers;

use PWWEB\Core\Contracts\Colour as ColorContract;
use PWWEB\Core\Exceptions\Colour\Exception as ColourException;
use PWWEB\Core\Helpers\Colour\Converter as ColorConverter;

/**
 * PWWEB\Core\Helpers\Colours Class.
 *
 * Defining the colour functionalities.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class Colour implements ColorContract
{
    /**
     * Red value.
     *
     * @var int
     */
    protected $red = 0;

    /**
     * Green value.
     *
     * @var int
     */
    protected $green = 0;

    /**
     * Blue value.
     *
     * @var int
     */
    protected $blue = 0;

    /**
     * Alpha value.
     *
     * @var float
     */
    protected $alpha = 1.0;

    /**
     * Color constructor.
     *
     * @param int   $red
     * @param int   $green
     * @param int   $blue
     *
     * @param float
     */
    public function __construct(int $red = 0, int $green = 0, int $blue = 0, float $alpha = 1.0)
    {
        $this->setRgba($red, $green, $blue, $alpha);
    }

    /**
     * Set the RGBA values.
     *
     * @param int   $red
     * @param int   $green
     * @param int   $blue
     * @param float $alpha
     *
     * @return self
     */
    public function setRgba(int $red, int $green, int $blue, float $alpha)
    {
        return $this->setRgb($red, $green, $blue)
            ->setAlpha($alpha);
    }

    /**
     * Set the RGB values.
     *
     * @param int $red
     * @param int $green
     * @param int $blue
     *
     * @return self
     */
    public function setRgb(int $red, int $green, int $blue)
    {
        return $this->setRed($red)->setGreen($green)->setBlue($blue);
    }

    /**
     * Get red value.
     *
     * @return int
     */
    public function red(): int
    {
        return $this->red;
    }

    /**
     * Set the red value.
     *
     * @param  int  $red
     *
     * @return self
     */
    public function setRed(int $red)
    {
        $this->checkColorValue('red', $red);
        $this->red = $red;

        return $this;
    }

    /**
     * Get the green value.
     *
     * @return int
     */
    public function green(): int
    {
        return $this->green;
    }

    /**
     * Set the green value.
     *
     * @param  int  $green
     *
     * @return self
     */
    public function setGreen(int $green)
    {
        $this->checkColorValue('green', $green);
        $this->green = $green;

        return $this;
    }

    /**
     * Get the blue value.
     *
     * @return int
     */
    public function blue(): int
    {
        return $this->blue;
    }

    /**
     * Set the blue value.
     *
     * @param  int  $blue
     *
     * @return self
     */
    public function setBlue(int $blue)
    {
        $this->checkColorValue('blue', $blue);
        $this->blue = $blue;

        return $this;
    }

    /**
     * Get the alpha value.
     *
     * @return float
     */
    public function alpha(): float
    {
        return (float) $this->alpha;
    }

    /**
     * Set the alpha value.
     *
     * @param  float|int  $alpha
     *
     * @return self
     */
    public function setAlpha(float $alpha)
    {
        $this->checkAlphaValue($alpha);
        $this->alpha = $alpha;

        return $this;
    }

    /**
     * Make a Color instance.
     *
     * @param string $color
     *
     * @return self
     */
    public static function make(string $color)
    {
        self::checkHex($color);

        list($red, $green, $blue) = ColorConverter::hexToRgb($color);

        return new self($red, $green, $blue);
    }

    /**
     * Convert to hex color.
     *
     * @param bool $uppercase
     *
     * @return string
     */
    public function toHex(bool $uppercase = true): string
    {
        $hex = ColorConverter::rgbToHex($this->red, $this->green, $this->blue);

        return $uppercase ? strtoupper($hex) : strtolower($hex);
    }

    /**
     * Parse the object to string.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->toHex();
    }

    /**
     * Check if the color is bright.
     *
     * @param float $contrast
     *
     * @return bool
     */
    public function isBright(float $contrast = 150.0): bool
    {
        return $contrast < sqrt(
            (pow($this->red, 2)   * .299) +
            (pow($this->green, 2) * .587) +
            (pow($this->blue, 2)  * .114)
        );
    }

    /**
     * Check if the color is dark.
     *
     * @param float $contrast
     *
     * @return bool
     */
    public function isDark(float $contrast = 150.0): bool
    {
        return ! $this->isBright($contrast);
    }

    /**
     * Check if the color is valid.
     *
     * @param string $hex
     *
     * @return bool
     */
    public static function isValidHex(string $hex): bool
    {
        return ColorValidator::validateHex($hex);
    }

    /**
     * Check the color.
     *
     * @param string $value
     *
     * @throws \PWWEB\Core\Exceptions\ColourException
     */
    private static function checkHex(string $value): void
    {
        if (false === self::isValidHex($value)) {
            throw new ColourException("Invalid HEX Color [$value].");
        }
    }

    /**
     * Set color value.
     *
     * @param string $name
     * @param int    $value
     *
     * @throws \PWWEB\Core\Exceptions\ColourException
     */
    private function checkColorValue(string $name, int $value): void
    {
        if (false === is_int($value)) {
            throw new ColourException("The $name value must be an integer.");
        }

        if ($value < 0 || $value > 255) {
            throw new ColourException(
                "The $name value must be between 0 and 255, [$value] is given."
            );
        }
    }

    /**
     * Check the alpha value.
     *
     * @param float $alpha
     *
     * @throws \PWWEB\Core\Exceptions\ColourException
     */
    public function checkAlphaValue(float &$alpha): void
    {
        if (false === is_numeric($alpha)) {
            throw new ColourException('The alpha value must be a float or an integer.');
        }

        $alpha = (float) $alpha;

        if ($alpha < 0 || $alpha > 1) {
            throw new ColourException(
                "The alpha value must be between 0 and 1, [$alpha] is given."
            );
        }
    }
}
// if (false === function_exists('hexToRgb')) {
//     function hexToRgb($hex)
//     {
//         if ('#' === $hex[0]) {
//             $hex = substr($hex, 1);
//         }
//
//         if (3 === strlen($hex)) {
//             $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
//         }
//
//         $r = hexdec($hex[0].$hex[1]);
//         $g = hexdec($hex[2].$hex[3]);
//         $b = hexdec($hex[4].$hex[5]);
//
//         return $b + ($g << 0x8) + ($r << 0x10);
//     }
// }
//
// if (false === function_exists('rgbToHsl')) {
//     function rgbToHsl($rgb)
//     {
//         $r = 0xFF & ($rgb >> 0x10);
//         $g = 0xFF & ($rgb >> 0x8);
//         $b = 0xFF & $rgb;
//
//         $r = ((float) $r) / 255.0;
//         $g = ((float) $g) / 255.0;
//         $b = ((float) $b) / 255.0;
//
//         $maxC = max($r, $g, $b);
//         $minC = min($r, $g, $b);
//
//         $l = ($maxC + $minC) / 2.0;
//
//         if ($maxC === $minC) {
//             $h = 0;
//             $s = 0;
//         } else {
//             if ($l < 0.5) {
//                 $s = ($maxC - $minC) / ($maxC + $minC);
//             } else {
//                 $s = ($maxC - $minC) / (2.0 - $maxC - $minC);
//             }
//
//             if ($r === $maxC) {
//                 $h = ($g - $b) / ($maxC - $minC);
//             }
//             if ($g === $maxC) {
//                 $h = 2.0 + ($b - $r) / ($maxC - $minC);
//             }
//             if ($b === $maxC) {
//                 $h = 4.0 + ($r - $g) / ($maxC - $minC);
//             }
//
//             $h = $h / 6.0;
//         }
//
//         $h = (int) round(255.0 * $h);
//         $s = (int) round(255.0 * $s);
//         $l = (int) round(255.0 * $l);
//
//         return (object) ['hue' => $h, 'saturation' => $s, 'luminance' => $l];
//     }
// }
