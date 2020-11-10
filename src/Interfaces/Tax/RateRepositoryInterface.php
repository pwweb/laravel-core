<?php

namespace PWWEB\Core\Interfaces\Tax;

use PWWEB\Core\Interfaces\BaseRepositoryInterface;
use PWWEB\Core\Models\Tax\Rate;

/**
 * PWWEB\Core\Interfaces\Tax\RateRepository RateRepository.
 *
 * The repository for Rate.
 * interface RateRepositoryInterface
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
interface RateRepositoryInterface extends BaseRepositoryInterface
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
     * @return \PWWEB\Core\Models\Tax\Rate
     **/
    public function model();
}
