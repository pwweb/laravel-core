<?php

namespace PWWEB\Core\Helpers;

use PWWEB\Core\Contracts\Colour as ColourContract;
use PWWEB\Core\Exceptions\Colour\Exception as ColourException;
use PWWEB\Core\Helpers\Colour\Converter as ColourConverter;
use PWWEB\Core\Helpers\Colour\Validator as ColourValidator;

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
class Colour implements ColourContract
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
     * Colour constructor.
     *
     * @param int   $red   Red value for the colour.
     * @param int   $green Green value for the colour.
     * @param int   $blue  Blue value for the colour.
     * @param float $alpha Alpha value for the colour.
     *
     * @return void
     */
    public function __construct(int $red = 0, int $green = 0, int $blue = 0, float $alpha = 1.0)
    {
        $this->setRgba($red, $green, $blue, $alpha);
    }

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
    public function setRgba(int $red, int $green, int $blue, float $alpha): Colour
    {
        return $this->setRgb($red, $green, $blue)
            ->setAlpha($alpha);
    }

    /**
     * Set the RGB values.
     *
     * @param int $red   Red value for the colour.
     * @param int $green Green value for the colour.
     * @param int $blue  Blue value for the colour.
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
     * @param int $red Red value for the colour.
     *
     * @return self
     */
    public function setRed(int $red)
    {
        $this->checkColourValue('red', $red);
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
     * @param int $green Green value for the colour.
     *
     * @return self
     */
    public function setGreen(int $green)
    {
        $this->checkColourValue('green', $green);
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
     * @param int $blue Blue value for the colour.
     *
     * @return self
     */
    public function setBlue(int $blue)
    {
        $this->checkColourValue('blue', $blue);
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
     * @param float $alpha Alpha value for the colour.
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
     * Make a Colour instance.
     *
     * @param string $colour Raw value of the colour.
     *
     * @return self
     */
    public static function make(string $colour)
    {
        self::checkHex($colour);

        [$red, $green, $blue] = ColourConverter::hexToRgb($colour);

        return new self($red, $green, $blue);
    }

    /**
     * Convert to hex colour.
     *
     * @param bool $uppercase Flag for transformation to uppercase.
     *
     * @return string
     */
    public function toHex(bool $uppercase = true): string
    {
        $hex = ColourConverter::rgbToHex($this->red, $this->green, $this->blue);

        if (true === $uppercase) {
            return strtoupper($hex);
        }

        return strtolower($hex);
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
     * Check if the colour is bright.
     *
     * @param float $contrast Contrast value of the colour.
     *
     * @return bool
     */
    public function isBright(float $contrast = 150.0): bool
    {
        return $contrast < sqrt(
            (pow($this->red, 2) * .299) + (pow($this->green, 2) * .587) + (pow($this->blue, 2) * .114)
        );
    }

    /**
     * Check if the colour is dark.
     *
     * @param float $contrast Contrast value of the colour.
     *
     * @return bool
     */
    public function isDark(float $contrast = 150.0): bool
    {
        return ! $this->isBright($contrast);
    }

    /**
     * Check if the colour is valid.
     *
     * @param string $hex HEX value of the colour.
     *
     * @return bool
     */
    public static function isValidHex(string $hex): bool
    {
        return ColourValidator::validateHex($hex);
    }

    /**
     * Check the colour.
     *
     * @param string $value Value of the colour.
     *
     * @return void
     *
     * @throws \PWWEB\Core\Exceptions\Colour\Exception
     */
    private static function checkHex(string $value): void
    {
        if (false === self::isValidHex($value)) {
            throw new ColourException("Invalid HEX Colour [$value].");
        }
    }

    /**
     * Set colour value.
     *
     * @param string $name  Colour aspect, e.g. red, green or blue.
     * @param int    $value Value of the colour aspect.
     *
     * @return void
     *
     * @throws \PWWEB\Core\Exceptions\Colour\Exception
     */
    private function checkColourValue(string $name, int $value): void
    {
        if ($value < 0 || $value > 255) {
            throw new ColourException(
                "The $name value must be between 0 and 255, [$value] is given."
            );
        }
    }

    /**
     * Check the alpha value.
     *
     * @param float $alpha Alpha value of the colour.
     *
     * @return void
     *
     * @throws \PWWEB\Core\Exceptions\Colour\Exception
     */
    public function checkAlphaValue(float &$alpha): void
    {
        $alpha = (float) $alpha;

        if ($alpha < 0 || $alpha > 1) {
            throw new ColourException(
                "The alpha value must be between 0 and 1, [$alpha] is given."
            );
        }
    }
}
