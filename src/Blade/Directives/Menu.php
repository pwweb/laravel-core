<?php

namespace PWWEB\Core\Blade\Directives;

use Illuminate\Contracts\Queue\QueueableCollection;
use Illuminate\Support\Str;
use PWWEB\Core\Blade\Directive;
use PWWEB\Core\Models\Menu\Item;
use PWWEB\Core\Repositories\Menu\EnvironmentRepository;
use PWWEB\Core\Repositories\Menu\ItemRepository;

/**
 * PWWEB\Core\Blade\Directive Menu.
 *
 * Blade directive to display a menu given the environment to display.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @method    handle()
 */
class Menu extends Directive
{
    /**
     * Repository of Environments to be used throughout the controller.
     *
     * @var EnvironmentRepository
     */
    private $environmentRepository;

    /**
     * Repository of Items to be used throughout the controller.
     *
     * @var ItemRepository
     */
    private $itemRepository;

    /**
     * Constructor for the Date Directive.
     *
     * @param ItemRepository        $itemRepo Repository of Items.
     * @param EnvironmentRepository $envRepo  Repository of Environments.
     */
    public function __construct(ItemRepository $itemRepo, EnvironmentRepository $envRepo)
    {
        $this->itemRepository = $itemRepo;
        $this->environmentRepository = $envRepo;

        // Set to false, to not generate a @endmenu directive.
        parent::__construct(false);
    }

    /**
     * Handle the functionality for the blade directive.
     *
     * @param string $expression List of expressions.
     *
     * @return string
     */
    public function handle(string $expression): string
    {
        $node = 'root';
        $depth = 10;

        if (true === Str::contains($expression, ',')) {
            $expression = self::multipleArgs($expression);

            $environment = $expression->get(0);

            if (null !== $expression->get(1)) {
                $node = self::stripQuotes($expression->get(1));
            }
            if (null !== $expression->get(2)) {
                $depth = $expression->get(2);
            }
        } else {
            $environment = $expression;
        }

        $environment = self::stripQuotes($environment);

        if ('' === $environment) {
            $environment = 'Frontend';
        }

        // Obtain the environment ID.
        $environment = $this->environmentRepository->findBySlug($environment);

        if (null === $environment) {
            $environmentId = 1;
        } else {
            $environmentId = $environment->id;
        }

        try {
            $items = $this->itemRepository->retrieve($environmentId, $node, $depth);
        } catch (\Exception $e) {
            return '';
        }

        return $this->render($items);
    }

    /**
     * Renders the menu according to bootstrap markup.
     *
     * @param QueueableCollection $items Menu items to be displayed.
     * @param string              $path  Parent path identifier.
     *
     * @return string
     */
    public function render(QueueableCollection $items, string $path = ''): string
    {
        if ('' !== $path) {
            $path = $path.'.';
        }

        $output = '';

        foreach ($items as $item) {
            if (1 === $item->seperator) {
                $output .= $this->renderSeparator($item, $path);
            } else {
                dd($item->children);
                if (true === isset($item->children)
                    && true === is_iterable($item->children)
                    && true === isset($item->children->first()->identifier)
                ) {
                    $output .= $this->renderDropdownItem($item, $path);
                } else {
                    $output .= $this->renderMenuItem($item, $path);
                }
            }
        }

        return $output;
    }

    /**
     * Render separator menu item.
     *
     * @param Item   $item   Menu item (separator) to display.
     * @param string $path   Base path for the menu item.
     * @param string $output (Optional) Output previously rendered.
     *
     * @return string
     */
    private function renderSeparator(Item $item, string $path, string $output = ''): string
    {
        if (true === isset($item->children) && true === is_iterable($item->children)) {
            $output .= '<li class="nav-title">'.$item->name.'</li>';
            $output .= $this->render($item->children, $path.$item->identifier);
        }

        return $output;
    }

    /**
     * Render dropdown menu item.
     *
     * @param Item   $item   Menu item (separator) to display.
     * @param string $path   Base path for the menu item.
     * @param string $output (Optional) Output previously rendered.
     *
     * @return string
     */
    private function renderDropdownItem(Item $item, string $path, string $output = ''): string
    {
        $parent = $path.$item->identifier;

        $output .= '<li class="nav-item dropdown">';
        $output .= '<a href="#" title="'.$item->identifier.'" class="nav-link dropdown-toggle" id="nav-dropdown-'.$item->identifier.'" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';

        if ('' !== $item->class) {
            $output .= '<span class="'.$item->class.'"></span>';
        }

        $output .= $item->name.'</a>';
        $output .= '<ul class="dropdown-menu" aria-labelledby="nav-dropdown-'.$item->identifier.'">';
        $output .= $this->render($item->children, $parent);
        $output .= '</ul>';
        $output .= '</li>';

        return $output;
    }

    /**
     * Render standard menu item.
     *
     * @param Item   $item   Menu item (separator) to display.
     * @param string $path   Base path for the menu item.
     * @param string $output (Optional) Output previously rendered.
     *
     * @return string
     */
    private function renderMenuItem(Item $item, string $path, string $output = ''): string
    {
        $output .= '<li class="nav-item">';

        if (true === \Route::has($path.$item->identifier.'.index')) {
            $output .= '<a href="{{ route("'.$path.$item->identifier.'.index") }}" title="'.$item->identifier.'" class="nav-link">';
        } else {
            $output .= '<a href="#" title="'.$item->identifier.'" class="nav-link">';
        }

        if ('' !== $item->class) {
            $output .= '<span class="'.$item->class.'"></span>';
        }

        $output .= $item->name.'</a>';
        $output .= '</li>';

        return $output;
    }
}
