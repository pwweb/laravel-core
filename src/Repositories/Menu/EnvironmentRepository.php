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
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class EnvironmentRepository extends BaseRepository
{
    /**
     * Fields that can be searched by.
     *
     * @var array
     */
    protected $fieldSearchable = [
        'name',
    ];

    /**
     * Return searchable fields.
     *
     * @return array
     */
    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model.
     *
     * @return string
     **/
    public function model(): string
    {
        return Environment::class;
    }
}
