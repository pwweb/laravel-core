<?php

namespace PWWEB\Core\Interfaces\User\Password;

use App\Interfaces\BaseRepositoryInterface;
use PWWEB\Core\Models\User;
use PWWEB\Core\Models\User\Password\History;

/**
 * PWWEB\Core\Interfaces\User\Password\HistoryRepository HistoryRepository.
 *
 * The repository for User Password History.
 * interface HistoryRepositoryInterface
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
interface HistoryRepositoryInterface extends BaseRepositoryInterface
{


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
     * Retrieve the historic passwords for a given user.
     *
     * @param int   $id      The ID of the user to retrieve historic passwords for.
     * @param array $columns [optional] The columns to return, defaults to * (all columns).
     *
     * @return History
     */
    public function findByUserId(int $id, array $columns = ['*']): ?History;


    /**
     * Check the password to be set against the last historic passwords. The amount of passwords
     * to check against is set per configuration (password_history_num) or .env variable (PASSWORD_HISTORY_NUM).
     *
     * @param User   $user     The user to be checked.
     * @param string $password Password to be checked.
     *
     * @return bool
     */
    public function isHistoricPassword(User $user, string $password): bool;
}
