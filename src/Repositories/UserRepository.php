<?php

namespace PWWEB\Core\Repositories;

use App\Repositories\BaseRepository;
use PWWEB\Core\Models\User;

/**
 * PWWEB\Core\Repositories\UserRepository UserRepository.
 *
 * The repository for User.
 * Class UserRepository
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
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
}
