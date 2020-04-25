<?php

namespace PWWEB\Core\Enums;

use Spatie\Enum\Enum;

/**
 * PWWEB\Core\Enums\Gender Enum.
 *
 * Standard Gender Enum.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @method    static self none()
 * @method    static self dr()
 * @method    static self prof()
 * @method    static self profdr()
 * @method    static self eng()
 * @method    static self dipling()
 */
abstract class Title extends Enum
{
    /**
     * No title for the person.
     *
     * @return Title
     */
    public static function none(): self
    {
        return new class() extends Title {
            // phpcs:ignore
            public function getIndex(): int
            {
                return 0;
            }

            // phpcs:ignore
            public function getValue(): string
            {
                return '';
            }
        };
    }

    /**
     * Doctor title for the person.
     *
     * @return Title
     */
    public static function dr(): self
    {
        return new class() extends Title {
            // phpcs:ignore
            public function getIndex(): int
            {
                return 1;
            }

            // phpcs:ignore
            public function getValue(): string
            {
                return __('Dr.');
            }
        };
    }

    /**
     * Professor title for the person.
     *
     * @return Title
     */
    public static function prof(): self
    {
        return new class() extends Title {
            // phpcs:ignore
            public function getIndex(): int
            {
                return 2;
            }

            // phpcs:ignore
            public function getValue(): string
            {
                return __('Prof.');
            }
        };
    }

    /**
     * Professor Doctor title for the person.
     *
     * @return Title
     */
    public static function profdr(): self
    {
        return new class() extends Title {
            // phpcs:ignore
            public function getIndex(): int
            {
                return 3;
            }

            // phpcs:ignore
            public function getValue(): string
            {
                return __('Prof. Dr.');
            }
        };
    }

    /**
     * Engineer title for the person.
     *
     * @return Title
     */
    public static function eng(): self
    {
        return new class() extends Title {
            // phpcs:ignore
            public function getIndex(): int
            {
                return 4;
            }

            // phpcs:ignore
            public function getValue(): string
            {
                return __('Eng.');
            }
        };
    }

    /**
     * Diploma Engineer title for the person (Germany-specific).
     *
     * @return Title
     */
    public static function dipling(): self
    {
        return new class() extends Title {
            // phpcs:ignore
            public function getIndex(): int
            {
                return 5;
            }

            // phpcs:ignore
            public function getValue(): string
            {
                return __('Dipl.-Ing.');
            }
        };
    }
}
