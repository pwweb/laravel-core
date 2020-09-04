<?php

namespace PWWEB\Core\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * PWWEB\Core\Rules\AbstractRule Rule.
 *
 * Base rule.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
abstract class AbstractRule implements Rule
{
    /**
     * @var string
     */
    protected $key = '';

    /**
     * @var string
     *
     * @link  http://stackoverflow.com/questions/12385500/regex-pattern-for-rgb-rgba-hsl-hsla-color-coding
     */
    protected $pattern = '';

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed  $value
     *
     * @return bool
     */
    public function passes(string $attribute, $value): bool
    {
        return $this->matchAll($this->pattern, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return trans("color::validation.{$this->key}.invalid");
    }

    /**
     * Check if match all.
     *
     * @param string $pattern
     * @param string $value
     *
     * @return bool
     */
    protected function matchAll(string $pattern, string $value): bool
    {
        return 0 !== preg_match_all($pattern, $value);
    }
}
