<?php

namespace PWWEB\Core\Controllers\Menu;

use App\Http\Controllers\Controller;
use Flash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use PWWEB\Core\Repositories\Menu\EnvironmentRepository;
use PWWEB\Core\Requests\Menu\CreateEnvironmentRequest;
use PWWEB\Core\Requests\Menu\UpdateEnvironmentRequest;

/**
 * PWWEB\Core\Controllers\Menu\EnvironmentController EnvironmentController.
 *
 * The CRUD controller for Environment
 * Class EnvironmentController
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class EnvironmentController extends Controller
{
    /**
     * Repository of Environments to be used throughout the controller.
     *
     * @var EnvironmentRepository
     */
    private $environmentRepository;

    /**
     *  Constructor for the Environment controller.
     *
     * @param EnvironmentRepository $environmentRepo Repository of Environments.
     */
    public function __construct(EnvironmentRepository $environmentRepo)
    {
        $this->environmentRepository = $environmentRepo;
    }

    /**
     * Display a listing of the Environment.
     *
     * @param Request $request Request containing the information for filtering.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request): View
    {
        $environments = $this->environmentRepository->all();

        return view('core::menu.environments.index')
            ->with('environments', $environments);
    }

    /**
     * Show the form for creating a new Environment.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('core::menu.environments.create');
    }

    /**
     * Store a newly created Environment in storage.
     *
     * @param CreateEnvironmentRequest $request Request containing the information to be stored.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateEnvironmentRequest $request): RedirectResponse
    {
        $input = $request->all();

        $environment = $this->environmentRepository->create($input);

        if (false === empty($environment)) {
            Flash::success('Environment saved successfully.');
        } else {
            Flash::error('Environment could not be saved.');
        }

        return redirect(route('core.menu.environments.index'));
    }

    /**
     * Display the specified Environment.
     *
     * @param int $id ID of the Environment to be displayed. Used for retrieving currently held data.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $environment = $this->environmentRepository->find($id);

        if (true === empty($environment)) {
            Flash::error('Environment not found');

            return redirect(route('core.menu.environments.index'));
        }

        return view('core::menu.environments.show')->with('environment', $environment);
    }

    /**
     * Show the form for editing the specified Environment.
     *
     * @param int $id ID of the Environment to be edited. Used for retrieving currently held data.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $environment = $this->environmentRepository->find($id);

        if (true === empty($environment)) {
            Flash::error('Environment not found');

            return redirect(route('core.menu.environments.index'));
        }

        return view('core::menu.environments.edit')->with('environment', $environment);
    }

    /**
     * Update the specified Environment in storage.
     *
     * @param int                      $id      ID of the Environment to be updated.
     * @param UpdateEnvironmentRequest $request Request containing the information to be updated.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UpdateEnvironmentRequest $request): RedirectResponse
    {
        $environment = $this->environmentRepository->find($id);

        if (true === empty($environment)) {
            Flash::error('Environment not found');

            return redirect(route('core.menu.environments.index'));
        }

        $environment = $this->environmentRepository->update($request->all(), $id);

        if (false === empty($environment)) {
            Flash::success('Environment updated successfully.');
        } else {
            Flash::error('Environment could not be updated.');
        }

        return redirect(route('core.menu.environments.index'));
    }

    /**
     * Remove the specified Environment from storage.
     *
     * @param int $id ID of the Environment to be destroyed.
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $environment = $this->environmentRepository->find($id);

        if (true === empty($environment)) {
            Flash::error('Environment not found');

            return redirect(route('core.menu.environments.index'));
        }

        $this->environmentRepository->delete($id);

        Flash::success('Environment deleted successfully.');

        return redirect(route('core.menu.environments.index'));
    }
}
