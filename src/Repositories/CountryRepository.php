<?php

namespace PWWEB\Core\Repositories;

use PWWEB\Core\Interfaces\CountryRepositoryInterface;
use PWWEB\Core\Models\Country;

/**
 * PWWEB\Core\Repositories\CountryRepository CountryRepository.
 *
 * The repository for Country.
 * Class CountryRepository
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class CountryRepository extends BaseRepository implements CountryRepositoryInterface
{
    /**
     * Fields that can be searched by.
     *
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'iso',
        'ioc',
        'active',
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
        return config('pwweb.core.models.country');
    }
}
