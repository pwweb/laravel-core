<?php

namespace PWWEB\Core\Controllers\Menu;

use App\Http\Controllers\Controller;
use Flash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use PWWEB\Core\Repositories\Menu\ItemRepository;
use PWWEB\Core\Requests\Menu\CreateItemRequest;
use PWWEB\Core\Requests\Menu\UpdateItemRequest;

/**
 * App\Http\Controllers\System\Menu\ItemController ItemController.
 *
 * The CRUD controller for Item
 * Class ItemController
 *
 * @package   pwweb/localisation
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class ItemController extends Controller
{
    /**
     * Repository of Items to be used throughout the controller.
     *
     * @var ItemRepository
     */
    private $itemRepository;

    /**
     *  Constructor for the Item controller.
     *
     * @param ItemRepository $itemRepo Repository of Items.
     */
    public function __construct(ItemRepository $itemRepo)
    {
        $this->itemRepository = $itemRepo;
    }

    /**
     * Display a listing of the Item.
     *
     * @param Request $request Request containing the information for filtering.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request): View
    {
        $items = $this->itemRepository->all();

        return view('core::menu.items.index')
            ->with('items', $items);
    }

    /**
     * Show the form for creating a new Item.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('core::menu.items.create');
    }

    /**
     * Store a newly created Item in storage.
     *
     * @param CreateItemRequest $request Request containing the information to be stored.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateItemRequest $request): RedirectResponse
    {
        $input = $request->all();

        $item = $this->itemRepository->create($input);

        Flash::success('Item saved successfully.');

        return redirect(route('core.menu.items.index'));
    }

    /**
     * Display the specified Item.
     *
     * @param int $id ID of the Item to be displayed. Used for retrieving currently held data.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $item = $this->itemRepository->find($id);

        if (true === empty($item)) {
            Flash::error('Item not found');

            return redirect(route('core.menu.items.index'));
        }

        return view('core::menu.items.show')->with('item', $item);
    }

    /**
     * Show the form for editing the specified Item.
     *
     * @param int $id ID of the Item to be edited. Used for retrieving currently held data.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $item = $this->itemRepository->find($id);

        if (true === empty($item)) {
            Flash::error('Item not found');

            return redirect(route('core.menu.items.index'));
        }

        return view('core::menu.items.edit')->with('item', $item);
    }

    /**
     * Update the specified Item in storage.
     *
     * @param int               $id      ID of the Item to be updated.
     * @param UpdateItemRequest $request Request containing the information to be updated.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UpdateItemRequest $request): RedirectResponse
    {
        $item = $this->itemRepository->find($id);

        if (true === empty($item)) {
            Flash::error('Item not found');

            return redirect(route('core.menu.items.index'));
        }

        $item = $this->itemRepository->update($request->all(), $id);

        Flash::success('Item updated successfully.');

        return redirect(route('core.menu.items.index'));
    }

    /**
     * Remove the specified Item from storage.
     *
     * @param int $id ID of the Environment to be destroyed.
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $item = $this->itemRepository->find($id);

        if (true === empty($item)) {
            Flash::error('Item not found');

            return redirect(route('core.menu.items.index'));
        }

        $this->itemRepository->delete($id);

        Flash::success('Item deleted successfully.');

        return redirect(route('core.menu.items.index'));
    }
}
