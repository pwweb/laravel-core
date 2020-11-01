<?php

namespace PWWEB\Core\Repositories;

use App\Repositories\BaseRepository;
use Kalnoy\Nestedset\Collection;
use PWWEB\Core\Models\Menu;

/**
 * PWWEB\Core\Repositories\MenuRepository MenuRepository.
 *
 * The repository for Menu.
 * Class MenuRepository
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class MenuRepository extends BaseRepository
{
    /**
     * Fields that can be searched by.
     *
     * @var array
     */
    protected $fieldSearchable = [
        '_lft',
        '_rgt',
        'parent_id',
        'route',
        'title',
        'separator',
        'visible',
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
     * @return Collection Menus
     */
    public function retrieve(string $rootNode = 'frontend', int $maxLevels = 10): ?Collection
    {
        $rootNode = $this->retrieveNode($rootNode);

        if (null === $rootNode) {
            return null;
        }

        return $rootNode->descendants->toTree();
    }

    /**
     * Retrive a specific node within the tree.
     *
     * @param string $node          Node identifier
     * @param int    $environmentId Environment ID
     *
     * @return Menu
     */
    public function retrieveNode(string $node = ''): ?Menu
    {
        if ('' === $node) {
            return null;
        }

        $query = $this->model->newQuery();

        $node = $query->where('route', '=', $node)
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
     * @return Menu
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
     * @param string $node The node to start at.
     *
     * @return array Crumbs
     */
    public function retrieveBreadcrumbs(string $node = '')
    {
        if ('' === $node) {
            return null;
        }

        $node = ltrim($node, '/');
        $node = $this->retrieveNode($node);
        if (null === $node) {
            return null;
        }

        $crumbs = $this->model->defaultOrder()->ancestorsAndSelf($node->id);

        return $crumbs;
    }
}
