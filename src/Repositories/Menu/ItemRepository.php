<?php

namespace PWWEB\Core\Repositories\Menu;

use App\Repositories\BaseRepository;
use PWWEB\Core\Models\Menu\Item;

/**
 * PWWEB\Core\Repositories\Menu\ItemRepository ItemRepository.
 *
 * The repository for Item.
 * Class ItemRepository
 *
 * @package   pwweb/localisation
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class ItemRepository extends BaseRepository
{
    /**
     * Fields that can be searched by.
     *
     * @var array
     */
    protected $fieldSearchable = [
        'system_menu_environments_id',
        '_lft',
        '_rgt',
        'parent_id',
        'level',
        'identifier',
        'title',
        'separator',
        'class'
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
        return Item::class;
    }
}
