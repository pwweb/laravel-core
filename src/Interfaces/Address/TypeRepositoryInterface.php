<?php

namespace PWWEB\Core\Interfaces\Address;

use PWWEB\Core\Interfaces\BaseRepositoryInterface;
use PWWEB\Core\Models\Address\Type;

/**
 * PWWEB\Core\Interfaces\Address\TypeRepository TypeRepository.
 *
 * The repository for Address Type.
 * interface TypeRepositoryInterface
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
interface TypeRepositoryInterface extends BaseRepositoryInterface
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
