<?php

namespace PWWEB\Core\Repositories\Menu;

use App\Repositories\BaseRepository;
use Kalnoy\Nestedset\Collection;
use PWWEB\Core\Models\Menu\Item;

/**
 * PWWEB\Core\Repositories\Menu\ItemRepository ItemRepository.
 *
 * The repository for Item.
 * Class ItemRepository
 *
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
        'environments_id',
        '_lft',
        '_rgt',
        'parent_id',
        'level',
        'identifier',
        'title',
        'separator',
        'class',
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
        return config('pwweb.core.models.menu_item');
    }

    /**
     * Retrieve a Node and it's descendants.
     *
     * @param int    $environmentId Environment ID
     * @param string $rootNode      The root node identifier.
     * @param int    $maxLevels     The max levels to descend.
     *
     * @return Collection MenuItems
     */
    public function retrieve(int $environmentId = 1, string $rootNode = 'root', int $maxLevels = 10): ?Collection
    {
        $rootNode = $this->retrieveNode($rootNode, $environmentId);

        if (null === $rootNode) {
            return null;
        }

        return $this->model
            ->where('environment_id', $environmentId)
            ->whereDescendantOf($rootNode)
            ->get()
            ->toTree();
    }

    /**
     * Retrive a specific node within the tree.
     *
     * @param string $node          Node identifier
     * @param int    $environmentId Environment ID
     *
     * @return Item
     */
    public function retrieveNode(string $node = '', int $environmentId = 1): ?Item
    {
        if ('' === $node || $environmentId <= 0) {
            return null;
        }

        $query = $this->model->newQuery();

        $node = $query->where('identifier', '=', $node)
            ->where('environment_id', '=', $environmentId)
            ->get();

        if (1 !== count($node)) {
            return null;
        }

        return $node->first();
    }

    /**
     * Create menu item record.
     *
     * @param array $input Values for new record creation.
     *
     * @return Item
     */
    public function create($input)
    {
        $node = $this->model->newInstance();
        $node->fill($input);
        $node->save();

        return $node;
    }

    /**
     * Retrive the breadcrumbs for a given node.
     *
     * @param String $node The node to start at.
     *
     * @return array Crumbs
     */
    public function retrieveBreadcrumbs(string $node = '', int $environmentId = 1)
    {
        if ('' === $node || $environmentId <= 0) {
            return null;
        }

        $node = ltrim($node, '/');
        $node = $this->retrieveNode($node, $environmentId);
        if (false === $node) {
            return null;
        }

        $crumbs = $this->model->defaultOrder()->ancestorsAndSelf($node->id);

        return $crumbs;
    }
}
