<?php

namespace PWWEB\Core\Controllers\Address;

use App\Http\Controllers\Controller;
use Flash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use PWWEB\Core\Interfaces\Address\TypeRepositoryInterface;
use PWWEB\Core\Requests\Address\CreateTypeRequest;
use PWWEB\Core\Requests\Address\UpdateTypeRequest;

/**
 * PWWEB\Core\Controllers\Address\TypeController TypeController.
 *
 * The CRUD controller for Type
 * Class TypeController
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class TypeController extends Controller
{
    /**
     * Repository of Address types to be used throughout the controller.
     *
     * @var TypeRepositoryInterface
     */
    private $typeRepository;

    /**
     * Constructor for the Address type controller.
     *
     * @param \PWWEB\Core\Interfaces\Address\TypeRepositoryInterface $typeRepo Repository of Address types
     */
    public function __construct(TypeRepositoryInterface $typeRepo)
    {
        $this->typeRepository = $typeRepo;
    }

    /**
     * Display a listing of the Address type.
     *
     * @param Request $request Request containing the information for filtering.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request): View
    {
        $types = $this->typeRepository->all();

        return view('core::addresses.types.index')
            ->with('types', $types);
    }

    /**
     * Show the form for creating a new Address type.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('core::addresses.types.create');
    }

    /**
     * Store a newly created Address type in storage.
     *
     * @param CreateTypeRequest $request Request containing the information to be stored.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateTypeRequest $request): RedirectResponse
    {
        $input = $request->all();

        $type = $this->typeRepository->create($input);

        Flash::success(__('pwweb::core.Type saved successfully', ['type' => $type->name]));

        return redirect(route('core.address.types.index'));
    }

    /**
     * Display the specified Address type.
     *
     * @param int $id ID of the Address type to be displayed. Used for retrieving currently held data.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $type = $this->typeRepository->find($id);

        if (true === empty($type)) {
            Flash::error(__('pwweb::core.Type not found', ['type' => $type->name]));

            return redirect(route('core.address.types.index'));
        }

        return view('core::addresses.types.show')->with('type', $type);
    }

    /**
     * Show the form for editing the specified Address type.
     *
     * @param int $id ID of the Address type to be edited. Used for retrieving currently held data.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $type = $this->typeRepository->find($id);

        if (true === empty($type)) {
            Flash::error(__('pwweb::core.Type not found', ['type' => $type->name]));

            return redirect(route('core.address.types.index'));
        }

        return view('core::addresses.types.edit')->with('type', $type);
    }

    /**
     * Update the specified Address type in storage.
     *
     * @param int               $id      ID of the Address type to be updated.
     * @param UpdateTypeRequest $request Request containing the information to be updated.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UpdateTypeRequest $request): RedirectResponse
    {
        $type = $this->typeRepository->find($id);

        if (true === empty($type)) {
            Flash::error(__('pwweb::core.Type not found', ['type' => $type->name]));

            return redirect(route('core.address.types.index'));
        }

        $type = $this->typeRepository->update($request->all(), $id);

        Flash::success(__('pwweb::core.Type updated successfully', ['type' => $type->name]));

        return redirect(route('core.address.types.index'));
    }

    /**
     * Remove the specified Address type from storage.
     *
     * @param int $id ID of the Address type to be destroyed.
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $type = $this->typeRepository->find($id);

        if (true === empty($type)) {
            Flash::error(__('pwweb::core.Type not found', ['type' => $type->name]));

            return redirect(route('core.address.types.index'));
        }

        $this->typeRepository->delete($id);

        Flash::success(__('pwweb::core.Type deleted successfully', ['type' => $type->name]));

        return redirect(route('core.address.types.index'));
    }
}
