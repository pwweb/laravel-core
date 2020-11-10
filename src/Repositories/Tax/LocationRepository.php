<?php

namespace PWWEB\Core\Repositories\Tax;

use PWWEB\Core\Interfaces\Tax\LocationRepositoryInterface;
use PWWEB\Core\Models\Tax\Location;
use PWWEB\Core\Repositories\BaseRepository;

/**
 * PWWEB\Core\Repositories\Tax\LocationRepository LocationRepository.
 *
 * The repository for Location.
 * Class LocationRepository
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class LocationRepository extends BaseRepository implements LocationRepositoryInterface
{
    /**
     * Fields that can be searched by.
     *
     * @var array
     */
    protected $fieldSearchable = [
        'country_id',
        'tax_rate_id',
        'state',
        'city',
        'zip',
        'order',
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
     * @return \PWWEB\Core\Models\Tax\Location
     **/
    public function model()
    {
        return config('pwweb.core.models.tax.location');
    }
}
