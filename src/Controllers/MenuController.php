<?php

namespace PWWEB\Core\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Laracasts\Flash\Flash;
use PWWEB\Core\Repositories\MenuRepository;
use PWWEB\Core\Requests\CreateMenuRequest;
use PWWEB\Core\Requests\UpdateMenuRequest;

/**
 * PWWEB\Core\Controllers\MenuController MenuController.
 *
 * The CRUD controller for Menu
 * Class MenuController
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class MenuController extends Controller
{
    /**
     * Repository of Menus to be used throughout the controller.
     *
     * @var MenuRepository
     */
    private $menuRepository;

    /**
     *  Constructor for the Menu controller.
     *
     * @param MenuRepository        $menuRepo Repository of Menus.
     */
    public function __construct(MenuRepository $menuRepo)
    {
        $this->menuRepository = $menuRepo;
    }

    /**
     * Display a listing of the Menu.
     *
     * @param Request $request Request containing the information for filtering.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request): View
    {
        $menus = $this->menuRepository->all();

        return view('core::menus.index')
            ->with('menus', $menus);
    }

    /**
     * Show the form for creating a new Menu.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('core::menus.create')
            ->with('nodes', $this->menuRepository->all());
    }

    /**
     * Store a newly created Menu in storage.
     *
     * @param CreateMenuRequest $request Request containing the information to be stored.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateMenuRequest $request): RedirectResponse
    {
        $input = $request->all();

        $menu = $this->menuRepository->create($input);

        if (false === empty($menu)) {
            Flash::success('Menu menu saved successfully.');
        } else {
            Flash::error('Menu menu could not be saved.');
        }

        return redirect(route('core.menus.index'));
    }

    /**
     * Display the specified Menu.
     *
     * @param int $id ID of the Menu to be displayed. Used for retrieving currently held data.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $menu = $this->menuRepository->find($id);

        if (true === empty($menu)) {
            Flash::error('Menu not found');

            return redirect(route('core.menus.index'));
        }

        return view('core::menus.show')->with('menu', $menu);
    }

    /**
     * Show the form for editing the specified Menu.
     *
     * @param int $id ID of the Menu to be edited. Used for retrieving currently held data.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $menu = $this->menuRepository->find($id);

        if (true === empty($menu)) {
            Flash::error('Menu not found');

            return redirect(route('core.menus.index'));
        }

        return view('core::menus.edit')
            ->with('menu', $menu)
            ->with('nodes', $this->menuRepository->all());
    }

    /**
     * Update the specified Menu in storage.
     *
     * @param int               $id      ID of the Menu to be updated.
     * @param UpdateMenuRequest $request Request containing the information to be updated.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UpdateMenuRequest $request): RedirectResponse
    {
        $menu = $this->menuRepository->find($id);

        if (true === empty($menu)) {
            Flash::error('Menu not found');

            return redirect(route('core.menus.index'));
        }

        $menu = $this->menuRepository->update($request->all(), $id);

        if (false === empty($menu)) {
            Flash::success('Menu menu updated successfully.');
        } else {
            Flash::error('Menu menu could not be updated.');
        }

        return redirect(route('core.menus.index'));
    }

    /**
     * Remove the specified Menu from storage.
     *
     * @param int $id ID of the Environment to be destroyed.
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $menu = $this->menuRepository->find($id);

        if (true === empty($menu)) {
            Flash::error('Menu not found');

            return redirect(route('core.menus.index'));
        }

        $this->menuRepository->delete($id);

        Flash::success('Menu deleted successfully.');

        return redirect(route('core.menus.index'));
    }
}
