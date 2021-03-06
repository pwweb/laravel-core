<?php

namespace PWWEB\Core\Listeners;

use Illuminate\Auth\Events\PasswordReset;
use PWWEB\Core\Interfaces\User\Password\HistoryRepositoryInterface;
use PWWEB\Core\Models\User;

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
     * @var HistoryRepositoryInterface
     */
    private $historyRepository;

    /**
     * Create the event listener.
     *
     * @param HistoryRepositoryInterface $historyRepo Repository of Historic Passwords.
     *
     * @return void
     */
    public function __construct(HistoryRepositoryInterface $historyRepo)
    {
        $this->historyRepository = $historyRepo;
    }

    /**
     * Handle the event.
     *
     * @param PasswordReset $event The password reset event to be handled.
     *
     * @return bool
     */
    public function handle(PasswordReset $event): bool
    {
        if ($event->user instanceof User) {
            $data = [];
            $data['user_id'] = $event->user->id;
            $data['password'] = $event->user->password;

            $this->historyRepository->create($data);

            return true;
        }

        return false;
    }
}
