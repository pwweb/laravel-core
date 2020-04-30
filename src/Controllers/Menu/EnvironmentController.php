<?php

namespace PWWEB\Core\Controllers\Menu;

use App\Http\Controllers\Controller;
use Flash;
use Illuminate\Http\Request;
use PWWEB\Core\Repositories\Menu\EnvironmentRepository;
use PWWEB\Core\Requests\Menu\CreateEnvironmentRequest;
use PWWEB\Core\Requests\Menu\UpdateEnvironmentRequest;
use Response;

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
     * [private description].
     *
     * @var EnvironmentRepository
     */
    private $environmentRepository;

    /**
     * [__construct description].
     *
     * @param EnvironmentRepository $environmentRepo [description]
     */
    public function __construct(EnvironmentRepository $environmentRepo)
    {
        $this->environmentRepository = $environmentRepo;
    }

    /**
     * Display a listing of the Environment.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $environments = $this->environmentRepository->all();

        return view('core::menu.environments.index')
            ->with('environments', $environments);
    }

    /**
     * Show the form for creating a new Environment.
     *
     * @return Response
     */
    public function create()
    {
        return view('core::menu.environments.create');
    }

    /**
     * Store a newly created Environment in storage.
     *
     * @param CreateEnvironmentRequest $request
     *
     * @return Response
     */
    public function store(CreateEnvironmentRequest $request)
    {
        $input = $request->all();

        $environment = $this->environmentRepository->create($input);

        Flash::success('Environment saved successfully.');

        return redirect(route('core.menu.environments.index'));
    }

    /**
     * Display the specified Environment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $environment = $this->environmentRepository->find($id);

        if (empty($environment)) {
            Flash::error('Environment not found');

            return redirect(route('core.menu.environments.index'));
        }

        return view('core::menu.environments.show')->with('environment', $environment);
    }

    /**
     * Show the form for editing the specified Environment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $environment = $this->environmentRepository->find($id);

        if (empty($environment)) {
            Flash::error('Environment not found');

            return redirect(route('core.menu.environments.index'));
        }

        return view('core::menu.environments.edit')->with('environment', $environment);
    }

    /**
     * Update the specified Environment in storage.
     *
     * @param int                      $id
     * @param UpdateEnvironmentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEnvironmentRequest $request)
    {
        $environment = $this->environmentRepository->find($id);

        if (empty($environment)) {
            Flash::error('Environment not found');

            return redirect(route('core.menu.environments.index'));
        }

        $environment = $this->environmentRepository->update($request->all(), $id);

        Flash::success('Environment updated successfully.');

        return redirect(route('core.menu.environments.index'));
    }

    /**
     * Remove the specified Environment from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $environment = $this->environmentRepository->find($id);

        if (empty($environment)) {
            Flash::error('Environment not found');

            return redirect(route('core.menu.environments.index'));
        }

        $this->environmentRepository->delete($id);

        Flash::success('Environment deleted successfully.');

        return redirect(route('core.menu.environments.index'));
    }
}
