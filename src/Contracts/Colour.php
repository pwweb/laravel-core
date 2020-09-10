<?php

namespace PWWEB\Core\Contracts;

/**
 * PWWEB\Core\Contracts\Colour Contract.
 *
 * Defining the contract for colours.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
interface Colour
{
    /**
     * Set the RGB values.
     *
     * @param int $red   Red value for the colour.
     * @param int $green Green value for the colour.
     * @param int $blue  Blue value for the colour.
     *
     * @return self
     */
    public function setRgb(int $red, int $green, int $blue);

    /**
     * Set the RGBA values.
     *
     * @param int   $red   Red value for the colour.
     * @param int   $green Green value for the colour.
     * @param int   $blue  Blue value for the colour.
     * @param float $alpha Alpha value for the colour.
     *
     * @return self
     */
    public function setRgba(int $red, int $green, int $blue, float $alpha);

    /**
     * Get red value.
     *
     * @return int
     */
    public function red(): int;

    /**
     * Set the red value.
     *
     * @param int $red Red value for the colour.
     *
     * @return self
     */
    public function setRed(int $red);

    /**
     * Get the green value.
     *
     * @return int
     */
    public function green(): int;

    /**
     * Set the green value.
     *
     * @param int $green Green value for the colour.
     *
     * @return self
     */
    public function setGreen(int $green);

    /**
     * Get the blue value.
     *
     * @return int
     */
    public function blue(): int;

    /**
     * Set the blue value.
     *
     * @param int $blue Blue value for the colour.
     *
     * @return self
     */
    public function setBlue(int $blue);

    /**
     * Get the alpha value.
     *
     * @return float
     */
    public function alpha(): float;

    /**
     * Set the alpha value.
     *
     * @param float $alpha Alpha value for the colour.
     *
     * @return self
     */
    public function setAlpha(float $alpha);

    /**
     * Make a Color instance.
     *
     * @param string $colour Raw value of the colour.
     *
     * @return self
     */
    public static function make(string $colour);

    /**
     * Convert to hex color.
     *
     * @param bool $uppercase Flag for transformation to uppercase.
     *
     * @return string
     */
    public function toHex(bool $uppercase = true): string;

    /**
     * Check if the color is bright.
     *
     * @param float $contrast Contrast value of the colour.
     *
     * @return bool
     */
    public function isBright(float $contrast = 150.0): bool;

    /**
     * Check if the color is dark.
     *
     * @param float $contrast Contrast value of the colour.
     *
     * @return bool
     */
    public function isDark(float $contrast = 150.0): bool;

    /**
     * Check if the color is valid.
     *
     * @param string $hex HEX value of the colour.
     *
     * @return bool
     */
    public static function isValidHex(string $hex): bool;
}
