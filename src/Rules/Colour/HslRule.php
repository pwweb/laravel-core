<?php

namespace PWWEB\Core\Rules\Colour;

use PWWEB\Core\Rules\AbstractRule;

/**
 * PWWEB\Core\Rules\Colour\HslRule Rule.
 *
 * HSL validation rule.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class HslRule extends AbstractRule
{
    /**
     * @var string
     */
    protected $key = 'hsl';

    /**
     * @var string
     */
    protected $pattern = '/^hsl\(\s*(0|[1-9]\d?|[12]\d\d|3[0-5]\d)\s*,\s*((0|[1-9]\d?|100)%)\s*,\s*((0|[1-9]\d?|100)%)\s*\)$/';
}
