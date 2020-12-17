<?php

namespace PWWEB\Core\Interfaces;

use App\Interfaces\BaseRepositoryInterface;
use Illuminate\Container\Container as Application;
use Kalnoy\Nestedset\Collection;
use PWWEB\Core\Models\Menu;

/**
 * PWWEB\Core\Interfaces\MenuRepository MenuRepository.
 *
 * The repository for Menu.
 * interface MenuRepositoryInterface
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
interface MenuRepositoryInterface extends BaseRepositoryInterface
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
    public function getFieldsSearchable(): array;

    /**
     * Configure the Model.
     *
     * @return string
     **/
    public function model(): string;

    /**
     * Retrieve a Node and it's descendants.
     *
     * @param int    $environmentId Environment ID
     * @param string $rootNode      The root node identifier.
     * @param int    $maxLevels     The max levels to descend.
     *
     * @return Collection Menus
     */
    public function retrieve(string $rootNode = 'frontend', int $maxLevels = 10): ?Collection;

    /**
     * Retrive a specific node within the tree.
     *
     * @param string $node          Node identifier
     * @param int    $environmentId Environment ID
     *
     * @return Menu
     */
    public function retrieveNode(string $node = ''): ?Menu;

    /**
     * Create menu item record.
     *
     * @param array $input Values for new record creation.
     *
     * @return Menu
     */
    public function create($input);

    /**
     * Retrive the breadcrumbs for a given node.
     *
     * @param string $node The node to start at.
     *
     * @return array Crumbs
     */
    public function retrieveBreadcrumbs(string $node = '');
}
