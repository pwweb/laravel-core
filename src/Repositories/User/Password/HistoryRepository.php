<?php

namespace PWWEB\Core\Repositories\User\Password;

use App\Repositories\BaseRepository;
use PWWEB\Core\Models\User;
use PWWEB\Core\Models\User\Password\History;

/**
 * PWWEB\Core\Repositories\User\Password\HistoryRepository HistoryRepository.
 *
 * The repository for User Password History.
 * Class HistoryRepository
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class HistoryRepository extends BaseRepository
{
    /**
     * Fields that can be searched by.
     *
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'password'
    ];

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
        return History::class;
    }

    /**
     * Retrieve the historic passwords for a given user.
     *
     * @param int   $id      The ID of the user to retrieve historic passwords for.
     * @param array $columns [optional] The columns to return, defaults to * (all columns).
     *
     * @return History
     */
    public function findByUserId(int $id, array $columns = ['*']): History
    {
        $query = $this->model->newQuery();
        $query->where('user_id', $id);

        return $query->find($id, $columns);
    }

    /**
     * Check the password to be set against the last historic passwords. The amount of passwords
     * to check against is set per configuration (password_history_num) or .env variable (PASSWORD_HISTORY_NUM).
     *
     * @param User   $user     The user to be checked.
     * @param string $password Password to be checked.
     *
     * @return bool
     */
    public function isHistoricPassword(User $user, string $password): bool
    {
        // Only check the password history for the same user.
        $currentUser = \Auth::user();

        if ($user->id === $currentUser->id) {
            $historicPasswords = $this->findByUserId($user->id);
            $historicPasswords = $historicPasswords->take(config('pwweb.core.password_history_num'))->get();

            foreach ($historicPasswords as $historicPassword) {
                if (true === \Hash::check($password, $historicPassword->password)) {
                    return true;
                }
            }
        }

        return false;
    }
}
