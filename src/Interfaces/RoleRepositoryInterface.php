<?php

namespace PWWEB\Core\Interfaces;

use Illuminate\Container\Container as Application;
use PWWEB\Core\Models\Role;

/**
 * PWWEB\Core\Interfaces\RoleRepository RoleRepository.
 *
 * The repository for Role.
 * interface RoleRepositoryInterface
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
interface RoleRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Contructor.
     *
     * @param Application $app Application instance.
     *
     * @throws \Exception
     */
    public function __construct(Application $app);

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
