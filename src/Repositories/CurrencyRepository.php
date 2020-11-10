<?php

namespace PWWEB\Core\Repositories;

use PWWEB\Core\Interfaces\CurrencyRepositoryInterface;
use PWWEB\Core\Models\Currency;

/**
 * PWWEB\Core\Repositories\CurrencyRepository CurrencyRepository.
 *
 * The repository for Currency.
 * Class CurrencyRepository
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class CurrencyRepository extends BaseRepository implements CurrencyRepositoryInterface
{
    /**
     * Fields that can be searched by.
     *
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'iso',
        'numeric_code',
        'entity_code',
        'active',
        'standard',
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
        return config('pwweb.core.models.currency');
    }
}
