<?php

namespace PWWEB\Core\Rules\Colour;

use PWWEB\Core\Rules\AbstractRule;

/**
 * PWWEB\Core\Rules\Colour\HexRule Rule.
 *
 * HEX validation rule.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class HexRule extends AbstractRule
{
    /**
     * Rule key
     *
     * @var string
     */
    protected $key = 'hex';

    /**
     * Rule pattern
     *
     * @var string
     */
    protected $pattern = '/^#(?:[0-9a-fA-F]{3}){1,2}$/';
}
