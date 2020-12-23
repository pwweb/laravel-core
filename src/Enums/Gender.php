<?php

namespace PWWEB\Core\Enums;

use Spatie\Enum\Enum;

/**
 * PWWEB\Core\Enums\Gender Enum.
 *
 * Standard Gender Enum.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 *
 * @method static self none()
 * @method static self male()
 * @method static self female()
 * @method static self diverse()
 */
class Gender extends Enum
{
    /**
     * Enum values.
     *
     * @return       string[]|int[]
     * @psalm-return array<string, string|int>
     */
    protected static function values(): array
    {
        return [
            'none' => 0,
            'male' => 1,
            'female' => 2,
            'diverse' => 3,
        ];
    }

    /**
     * Enum labels.
     *
     * @return       string[]
     * @psalm-return array<string, string>
     */
    protected static function labels(): array
    {
        return [
            'none' => __(''),
            'male' => __('male'),
            'female' => __('female'),
            'diverse' => __('diverse'),
        ];
    }
}
