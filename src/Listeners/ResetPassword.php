<?php

namespace PWWEB\Core\Listeners;

use Illuminate\Auth\Events\PasswordReset;
use PWWEB\Core\Repositories\User\Password\HistoryRepository;

/**
 * PWWEB\Core\Listeners\ResetPassword Listener.
 *
 * Standard Listener for resetting passwords.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

class ResetPassword
{
    /**
     * Repository of Password Histories to be used throughout the Listener.
     *
     * @var HistoryRepository
     */
    private $historyRepository;

    /**
     * Create the event listener.
     *
     * @param HistoryRepository $historyRepo Repository of Historic Passwords.
     *
     * @return void
     */
    public function __construct(HistoryRepository $historyRepo)
    {
        $this->historyRepository = $historyRepo;
    }

    /**
     * Handle the event.
     *
     * @param PasswordReset $event The password reset event to be handled.
     *
     * @return void
     */
    public function handle(PasswordReset $event)
    {
        $data = [];
        $data['user_id'] = $event->user->id;
        $data['password'] = $event->user->password;

        $this->historyRepository->create($data);
    }
}
