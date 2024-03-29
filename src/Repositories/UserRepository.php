<?php

namespace PWWEB\Core\Repositories;

use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Collection;
use PWWEB\Core\Exceptions\User\NotFound as UserNotFoundException;
use PWWEB\Core\Exceptions\User\Password\HistoricPasswordNotAllowed as HistoricPasswordNotAllowedException;
use PWWEB\Core\Exceptions\User\Password\NotMatching as NotMatchingException;
use PWWEB\Core\Interfaces\User\Password\HistoryRepositoryInterface;
use PWWEB\Core\Interfaces\UserRepositoryInterface;
use PWWEB\Core\Models\User;

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
class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * Repository of Historic Passwords to be used throughout the controller.
     *
     * @var HistoryRepository
     */
    private $historyRepository;

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
     * @param Application                $app         Application container.
     * @param HistoryRepositoryInterface $historyRepo Repository of Historic Passwords.
     *
     * @return void
     */
    public function __construct(Application $app, HistoryRepositoryInterface $historyRepo)
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
        return config('pwweb.core.models.user');
    }

    /**
     * Changes the password for a user.
     *
     * @param int   $id    User ID to change the password for.
     * @param array $input Request information for password change, including old, new and repeat password.
     *
     * @return bool
     */
    public function changePassword(int $id, array $input): bool
    {
        // Get the user for the ID.
        $user = $this->find($id)->first();

        // Check that the user exists.
        if (null === $user) {
            throw new UserNotFoundException();
        }

        // Check the current password.
        if (false === \Hash::check($input['current'], $user->password)) {
            throw new NotMatchingException();
        }

        if (true === $this->historyRepository->isHistoricPassword($user, $input['password'])) {
            throw new HistoricPasswordNotAllowedException();
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

    /**
     * Find user record for given ID.
     *
     * @param string $username The username of the record to be retrieved.
     * @param array  $columns  Column names to retrieve.
     *
     * @return User
     */
    public function findByUsername(string $username, array $columns = ['*']): ?User
    {
        $query = $this->model->newQuery();

        return $query->where('username', $username)->get($columns)->first();
    }

    /**
     * Find users that have a certain permission.
     *
     * @param string $permission The permission to retrieve users of.
     * @param array  $columns    Column names to retrieve.
     *
     * @return Collection
     */
    public function can(string $permission, array $columns = ['*']): ?Collection
    {
        return $this->model->permission($permission)->get($columns);
    }

    /**
     * Find users that have a certain role.
     *
     * @param string $role    The role to retrieve users of.
     * @param array  $columns Column names to retrieve.
     *
     * @return Collection
     */
    public function memberOf(string $role, array $columns = ['*']): ?Collection
    {
        return $this->model->role($role)->get($columns);
    }
}
