<?php

namespace PWWEB\Core\Interfaces;

use PWWEB\Core\Models\Address;

/**
 * PWWEB\Core\Interfaces\AddressRepository AddressRepository.
 *
 * The repository for Address.
 * interface AddressRepositoryInterface
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
interface AddressRepositoryInterface extends BaseRepositoryInterface
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
