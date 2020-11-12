<?php

namespace PWWEB\Core\Interfaces;

use PWWEB\Core\Models\ExchangeRate;

/**
 * PWWEB\Core\Interfaces\ExchangeRateRepository ExchangeRateRepository.
 *
 * The repository for ExchangeRate.
 * interface ExchangeRateRepositoryInterface
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
interface ExchangeRateRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Return searchable fields.
     *
     * @return array
     */
    public function getFieldsSearchable();

    /**
     * Configure the Model.
     *
     * @return string
     **/
    public function model();
}
