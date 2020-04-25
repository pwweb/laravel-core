<?php

namespace PWWEB\Core\Repositories;

use App\Repositories\BaseRepository;
use PWWEB\Core\Models\Person;

/**
 * PWWEB\Core\Repositories\PersonRepository PersonRepository.
 *
 * The repository for Address.
 * Class AddressRepository
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class PersonRepository extends BaseRepository
{
    /**
     * Fields that can be searched by.
     *
     * @var array
     */
    protected $fieldSearchable = [
        'nationality_id',
        'title',
        'name',
        'middle_name',
        'surname',
        'maiden_name',
        'gender',
        'dob',
        'display_name',
        'display_middle_name',
        'select_name',
    ];

    /**
     * Return searchable fields.
     *
     * @return array
     */
    public function getFieldsSearchable() : array
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model.
     *
     * @return string
     **/
    public function model() : string
    {
        return Person::class;
    }
}
