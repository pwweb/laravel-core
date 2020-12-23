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
 * @method static self dr()
 * @method static self prof()
 * @method static self profdr()
 * @method static self eng()
 * @method static self dipling()
 */
class Title extends Enum
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
            'dr' => 1,
            'prof' => 2,
            'profdr' => 3,
            'eng' => 4,
            'dipling' => 5,
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
            'dr' => __('Dr.'),
            'prof' => __('Prof.'),
            'profdr' => __('Prof. Dr.'),
            'eng' => __('Eng.'),
            'dipling' => __('Dipl-Ing.'),
        ];
    }
}
