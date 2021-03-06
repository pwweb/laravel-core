<?php

namespace PWWEB\Core\Exceptions\User;

use Exception;

/**
 * PWWEB\Core\Exceptions\User NotFound.
 *
 * The exception for non-existing users.
 * Class NotFound
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @property  string message
 */
class NotFound extends Exception
{
    /**
     * The exception message.
     *
     * @var string
     */
    protected $message = 'The user does not exist.';
}
