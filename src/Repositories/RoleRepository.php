<?php

namespace PWWEB\Core\Repositories;

use PWWEB\Core\Interfaces\RoleRepositoryInterface;

/**
 * PWWEB\Core\Repositories\RoleRepository RoleRepository.
 *
 * The repository for Role.
 * Class RoleRepository
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    /**
     * Fields that can be searched by.
     *
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'guard_name',
    ];

    /**
     * Return searchable fields.
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model.
     *
     * @return string
     **/
    public function model()
    {
        return config('permission.models.role');
    }
}
