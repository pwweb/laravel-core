<?php

namespace PWWEB\Core\Rules\Colour;

use PWWEB\Core\Rules\AbstractRule;

/**
 * PWWEB\Core\Rules\Colour\HslaRule Rule.
 *
 * HSLA validation rule.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class HslaRule extends AbstractRule
{
    /**
     * @var string
     */
    protected $key = 'hsla';

    /**
     * @var string
     */
    protected $pattern = '/^hsla\(\s*(0|[1-9]\d?|[12]\d\d|3[0-5]\d)\s*,\s*((0|[1-9]\d?|100)%)\s*,\s*((0|[1-9]\d?|100)%)\s*\,\s*((0.[1-9])|[01])\s*\)$/';
}
