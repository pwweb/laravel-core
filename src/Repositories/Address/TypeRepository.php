<?php

namespace PWWEB\Core\Repositories\Address;

use PWWEB\Core\Interfaces\Address\TypeRepositoryInterface;
use PWWEB\Core\Models\Address\Type;
use PWWEB\Core\Repositories\BaseRepository;

/**
 * PWWEB\Core\Repositories\Address\TypeRepository TypeRepository.
 *
 * The repository for Address Type.
 * Class TypeRepository
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class TypeRepository extends BaseRepository implements TypeRepositoryInterface
{
    /**
     * Fields that can be searched by.
     *
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'global',
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
        return config('pwweb.core.models.address_type');
    }
}
