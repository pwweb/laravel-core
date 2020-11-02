<?php

namespace PWWEB\Core\Blade\Directives;

use Illuminate\Contracts\Queue\QueueableCollection;
use Illuminate\Support\Str;
use PWWEB\Core\Blade\Directive;
use PWWEB\Core\Models\Menu as MenuModel;
use PWWEB\Core\Repositories\MenuRepository;

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
     * Repository of Menus to be used throughout the controller.
     *
     * @var MenuRepository
     */
    private $menuRepository;

    /**
     * Constructor for the Date Directive.
     *
     * @param MenuRepository        $menuRepo Repository of Menus.
     */
    public function __construct(MenuRepository $menuRepo)
    {
        $this->menuRepository = $menuRepo;

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
        $depth = 10;

        if (true === Str::contains($expression, ',')) {
            $expression = self::multipleArgs($expression);

            $node = $expression->get(0);

            if (null !== $expression->get(1)) {
                $depth = $expression->get(1);
            }
        } else {
            $node = $expression;
        }

        $node = self::stripQuotes($node);

        if ('' === $node) {
            $node = 'frontend';
        }

        try {
            $menus = $this->menuRepository->retrieve($node, $depth);
        } catch (\Exception $e) {
            return '';
        }

        return $this->render($menus);
    }

    /**
     * Renders the menu according to bootstrap markup.
     *
     * @param QueueableCollection $menus Menu menus to be displayed.
     * @param string              $path  Parent path route.
     *
     * @return string
     */
    public function render(QueueableCollection $menus, string $path = ''): string
    {
        if ('' !== $path) {
            $path = $path.'.';
        }

        $output = '';

        foreach ($menus as $menu) {
            if (1 === $menu->seperator) {
                $output .= $this->renderSeparator($menu, $path);
            } else {
                dd($menu->children);
                if (true === isset($menu->children)
                    && true === is_iterable($menu->children)
                    && true === isset($menu->children->first()->route)
                ) {
                    $output .= $this->renderDropdownMenu($menu, $path);
                } else {
                    $output .= $this->renderMenuMenu($menu, $path);
                }
            }
        }

        return $output;
    }

    /**
     * Render separator menu menu.
     *
     * @param MenuModel   $menu   Menu menu (separator) to display.
     * @param string $path   Base path for the menu menu.
     * @param string $output (Optional) Output previously rendered.
     *
     * @return string
     */
    private function renderSeparator(MenuModel $menu, string $path, string $output = ''): string
    {
        if (true === isset($menu->children) && true === is_iterable($menu->children)) {
            $output .= '<li class="nav-title">'.$menu->name.'</li>';
            $output .= $this->render($menu->children, $path.$menu->route);
        }

        return $output;
    }

    /**
     * Render dropdown menu menu.
     *
     * @param MenuModel   $menu   Menu menu (separator) to display.
     * @param string $path   Base path for the menu menu.
     * @param string $output (Optional) Output previously rendered.
     *
     * @return string
     */
    private function renderDropdownMenu(MenuModel $menu, string $path, string $output = ''): string
    {
        $parent = $path.$menu->route;

        $output .= '<li class="nav-menu dropdown">';
        $output .= '<a href="#" title="'.$menu->route.'" class="nav-link dropdown-toggle" id="nav-dropdown-'.$menu->route.'" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';

        if ('' !== $menu->class) {
            $output .= '<span class="'.$menu->class.'"></span>';
        }

        $output .= $menu->name.'</a>';
        $output .= '<ul class="dropdown-menu" aria-labelledby="nav-dropdown-'.$menu->route.'">';
        $output .= $this->render($menu->children, $parent);
        $output .= '</ul>';
        $output .= '</li>';

        return $output;
    }

    /**
     * Render standard menu menu.
     *
     * @param MenuModel   $menu   Menu menu (separator) to display.
     * @param string $path   Base path for the menu menu.
     * @param string $output (Optional) Output previously rendered.
     *
     * @return string
     */
    private function renderMenuMenu(MenuModel $menu, string $path, string $output = ''): string
    {
        $output .= '<li class="nav-menu">';

        if (true === \Route::has($path.$menu->route.'.index')) {
            $output .= '<a href="{{ route("'.$path.$menu->route.'.index") }}" title="'.$menu->route.'" class="nav-link">';
        } else {
            $output .= '<a href="#" title="'.$menu->route.'" class="nav-link">';
        }

        if ('' !== $menu->class) {
            $output .= '<span class="'.$menu->class.'"></span>';
        }

        $output .= $menu->name.'</a>';
        $output .= '</li>';

        return $output;
    }
}
