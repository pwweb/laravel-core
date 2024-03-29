<?php

namespace PWWEB\Core\Enums\Tax;

use Spatie\Enum\Enum;

/**
 * PWWEB\Core\Enums\Tax\Type Enum.
 *
 * Standard Tax Type Enum.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 *
 * @method static self none()
 * @method static self standard()
 * @method static self reduced()
 * @method static self higher()
 * @method static self zero()
 */
class Type extends Enum
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
            'standard' => 1,
            'reduced' => 2,
            'zero' => 3,
            'higher' => 4,
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
            'standard' => __('pwweb::core.tax.rates.standard_rate'),
            'reduced' => __('pwweb::core.tax.rates.reduced_rate'),
            'zero' => __('pwweb::core.tax.rates.zero_rate'),
            'higher' => __('pwweb::core.tax.rates.higher_rate'),
        ];
    }
}
