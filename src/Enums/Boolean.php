<?php

namespace PWWEB\Core\Enums;

use Spatie\Enum\Enum;

/**
 * PWWEB\Core\Enums\Boolean Enum.
 *
 * Standard Boolean Enum.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @method    static self false()
 * @method    static self true()
 */
abstract class Boolean extends Enum
{
    /**
     * False Boolean.
     *
     * @return Boolean
     */
    public static function false(): self
    {
        return new class() extends Boolean {
            // phpcs:ignore
            public function getIndex(): int
            {
                return 0;
            }

            // phpcs:ignore
            public function getValue(): string
            {
                $value = __('pwweb::core.false');

                if (true === is_array($value)) {
                    $value = $value[0];
                }

                return (string) $value;
            }
        };
    }

    /**
     * True Boolean.
     *
     * @return Boolean
     */
    public static function true(): self
    {
        return new class() extends Boolean {
            // phpcs:ignore
            public function getIndex(): int
            {
                return 1;
            }

            // phpcs:ignore
            public function getValue(): string
            {
                $value = __('pwweb::core.true');

                if (true === is_array($value)) {
                    $value = $value[0];
                }

                return (string) $value;
            }
        };
    }
}
