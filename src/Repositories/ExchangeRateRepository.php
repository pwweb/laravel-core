<?php

namespace PWWEB\Core\Repositories;

use PWWEB\Core\Models\ExchangeRate;

/**
 * PWWEB\Core\Repositories\ExchangeRateRepository ExchangeRateRepository.
 *
 * The repository for ExchangeRate.
 * Class ExchangeRateRepository
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class ExchangeRateRepository extends BaseRepository
{
    /**
     * Fields that can be searched by.
     *
     * @var array
     */
    protected $fieldSearchable = [
        'currency_id',
        'rate',
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
        return config('pwweb.core.models.exchange_rate');
    }
}
