<?php

namespace PWWEB\Core\Rules\Colour;

use PWWEB\Core\Rules\AbstractRule;

/**
 * PWWEB\Core\Rules\Colour\RgbRule Rule.
 *
 * RGB validation rule.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class RgbRule extends AbstractRule
{
    /**
     * Rule key
     *
     * @var string
     */
    protected $key = 'rgb';

    /**
     * Rule pattern
     *
     * @var string
     */
    protected $pattern = '/^rgb\(\s*(0|[1-9]\d?|1\d\d?|2[0-4]\d|25[0-5])\s*,\s*(0|[1-9]\d?|1\d\d?|2[0-4]\d|25[0-5])\s*,\s*(0|[1-9]\d?|1\d\d?|2[0-4]\d|25[0-5])\s*\)$/';
}
