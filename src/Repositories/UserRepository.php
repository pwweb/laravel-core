<?php

namespace PWWEB\Core\Repositories;

use Illuminate\Container\Container as Application;
use PWWEB\Core\Exceptions\User\NotFound as UserNotFoundException;
use PWWEB\Core\Exceptions\User\Password\HistoricPasswordNotAllowed as HistoricPasswordNotAllowedException;
use PWWEB\Core\Exceptions\User\Password\NotMatching as NotMatchingException;
use PWWEB\Core\Models\User;
use PWWEB\Core\Repositories\User\Password\HistoryRepository;

/**
 * PWWEB\Core\Repositories\UserRepository UserRepository.
 *
 * The repository for User.
 * Class UserRepository
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class UserRepository extends BaseRepository
{
    /**
     * Fields that can be searched by.
     *
     * @var array
     */
    protected $fieldSearchable = [
        'person_id',
        'email',
        'email_verified_at',
    ];

    /**
     * User Repository constructor.
     *
     * @param Application       $app         Application container.
     * @param HistoryRepository $historyRepo Repository of Historic Passwords.
     *
     * @return void
     */
    public function __construct(Application $app, HistoryRepository $historyRepo)
    {
        $this->historyRepository = $historyRepo;
        parent::__construct($app);
    }

    /**
     * Return searchable fields.
     *
     * @return array
     */
    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model.
     *
     * @return string
     **/
    public function model(): string
    {
        return User::class;
    }

    /**
     * [changePassword description].
     *
     * @param int   $id    [description]
     * @param array $input [description]
     *
     * @return bool [description]
     */
    public function changePassword(int $id, array $input): bool
    {
        // Get the user for the ID.
        $user = $this->find($id);

        // Check that the user exists.
        if (null === $user) {
            throw new UserNotFoundException();
            return false;
        }

        // Check the current password.
        if (false === \Hash::check($input['current'], $user->password)) {
            throw new NotMatchingException();
            return false;
        }

        // Only check the password history for the same user.
        $currentUser = \Auth::user();

        if ($user->id === $currentUser->id) {
            $historicPasswords = $currentUser->passwordHistories()->take(config('pwweb.core.password_history_num'))->get();

            foreach ($historicPasswords as $historicPassword) {
                if (true === \Hash::check($input['password'], $historicPassword->password)) {
                    throw new HistoricPasswordNotAllowedException();
                    return false;
                }
            }
        }

        // Hash the password.
        $input['password'] = \Hash::make($input['password']);
        $updated = $this->update($input, $id);

        if ($updated instanceof User) {
            $history = [];
            $history['user_id'] = $updated->id;
            $history['password'] = $updated->password;

            $this->historyRepository->create($history);
        }

        return true;
    }
}
