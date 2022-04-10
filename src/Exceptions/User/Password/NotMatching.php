<?php

namespace PWWEB\Core\Exceptions\User\Password;

use Exception;

/**
 * PWWEB\Core\Exceptions\User\Password NotMatching.
 *
 * The exception for not matching passwords.
 * Class NotMatching
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 *
 * @property  string message
 */
class NotMatching extends Exception
{
    /**
     * The exception message.
     *
     * @var string
     */
    protected $message = 'The entered password does not match the one on record.';
}
