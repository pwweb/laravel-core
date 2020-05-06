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
                $value = __('');

                if (true === is_array($value)) {
                    $value = (string) $value[];
                }
                return $value;
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
                $value = __('Dr.');

                if (true === is_array($value)) {
                    $value = (string) $value[];
                }
                return $value;
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
                $value = __('Prof.');

                if (true === is_array($value)) {
                    $value = (string) $value[];
                }
                return $value;
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
                $value = __('Prof. Dr.');

                if (true === is_array($value)) {
                    $value = (string) $value[];
                }
                return $value;
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
                $value = __('Eng.');

                if (true === is_array($value)) {
                    $value = (string) $value[];
                }
                return $value;
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
                $value = __('Dipl.-Ing.');

                if (true === is_array($value)) {
                    $value = (string) $value[];
                }
                return $value;
            }
        };
    }
}
