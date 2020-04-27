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
 * @method    static self none()
 * @method    static self male()
 * @method    static self female()
 * @method    static self diverse()
 */
abstract class Gender extends Enum
{
    /**
     * No Gender.
     *
     * @return Gender
     */
    public static function none(): self
    {
        return new class() extends Gender {
            // phpcs:ignore
            public function getIndex(): int
            {
                return 0;
            }

            // phpcs:ignore
            public function getValue(): string
            {
                return __('');
            }
        };
    }

    /**
     * Male Gender.
     *
     * @return Gender
     */
    public static function male(): self
    {
        return new class() extends Gender {
            // phpcs:ignore
            public function getIndex(): int
            {
                return 1;
            }

            // phpcs:ignore
            public function getValue(): string
            {
                return __('male');
            }
        };
    }

    /**
     * Female Gender.
     *
     * @return Gender
     */
    public static function female(): self
    {
        return new class() extends Gender {
            // phpcs:ignore
            public function getIndex(): int
            {
                return 2;
            }

            // phpcs:ignore
            public function getValue(): string
            {
                return __('female');
            }
        };
    }

    /**
     * Diverse Gender / Prefer not to say.
     *
     * @return Gender
     */
    public static function diverse(): self
    {
        return new class() extends Gender {
            // phpcs:ignore
            public function getIndex(): int
            {
                return 3;
            }

            // phpcs:ignore
            public function getValue(): string
            {
                return __('diverse');
            }
        };
    }
}
