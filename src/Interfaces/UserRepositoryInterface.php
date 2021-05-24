<?php

namespace PWWEB\Core\Interfaces;

use Illuminate\Container\Container as Application;
use PWWEB\Core\Interfaces\User\Password\HistoryRepositoryInterface;
use PWWEB\Core\Interfaces\BaseRepositoryInterface;
use PWWEB\Core\Models\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * PWWEB\Core\Interfaces\UserRepository UserRepository.
 *
 * The repository for User.
 * interface UserRepositoryInterface
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
interface UserRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * User Repository constructor.
     *
     * @param Application                $app         Application container.
     * @param HistoryRepositoryInterface $historyRepo Repository of Historic Passwords.
     *
     * @return void
     */
    public function __construct(Application $app, HistoryRepositoryInterface $historyRepo);

    /**
     * Return searchable fields.
     *
     * @return array
     */
    public function getFieldsSearchable(): array;

    /**
     * Configure the Model.
     *
     * @return string
     **/
    public function model(): string;

    /**
     * Changes the password for a user.
     *
     * @param int   $id    User ID to change the password for.
     * @param array $input Request information for password change, including old, new and repeat password.
     *
     * @return bool
     */
    public function changePassword(int $id, array $input): bool;

    /**
     * Find user record for given ID.
     *
     * @param string $username The username of the record to be retrieved.
     * @param array  $columns  Column names to retrieve.
     *
     * @return User
     */
    public function findByUsername(string $username, array $columns = ['*']): ?User;

    /**
     * Find users that have a certain permission.
     *
     * @param string $permission The permission to retrieve users of.
     *
     * @return Collection
     */
    public function can(string $permission): ?Collection;

    /**
     * Find users that have a certain role.
     *
     * @param string $role The role to retrieve users of.
     *
     * @return Collection
     */
    public function memberOf(string $role): ?Collection;
}
