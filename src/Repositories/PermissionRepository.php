<?php

namespace PWWEB\Core\Repositories;

use PWWEB\Core\Interfaces\PermissionRepositoryInterface;

/**
 * PWWEB\Core\Repositories\PermissionRepository PermissionRepository.
 *
 * The repository for Permission.
 * Class PermissionRepository
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
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
        return config('permission.models.permission');
    }
}
