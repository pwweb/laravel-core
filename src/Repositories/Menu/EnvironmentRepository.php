<?php

namespace PWWEB\Core\Repositories\Menu;

use App\Repositories\BaseRepository;
use PWWEB\Core\Models\Menu\Environment;

/**
 * PWWEB\Core\Repositories\Menu\EnvironmentRepository EnvironmentRepository.
 *
 * The repository for Environment.
 * Class EnvironmentRepository
 *
 * @package   pwweb/localisation
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class EnvironmentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
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
     **/
    public function model()
    {
        return Environment::class;
    }
}
