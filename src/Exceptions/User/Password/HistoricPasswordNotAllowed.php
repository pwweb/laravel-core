<?php

namespace PWWEB\Core\Exceptions\User\Password;

use Exception;

/**
 * PWWEB\Core\Exceptions\User\Password HistoricPasswordNotAllowed.
 *
 * The exception for not allowing historic passwords.
 * Class HistoricPasswordNotAllowed
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @property  string message
 */

class HistoricPasswordNotAllowed extends Exception
{
    /**
     * The exception message.
     *
     * @var string
     */
    protected $message = 'Your new password can not be same as any of your recent passwords. Please choose a new password.';
}
