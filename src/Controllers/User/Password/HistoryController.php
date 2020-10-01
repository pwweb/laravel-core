<?php

namespace PWWEB\Core\Controllers\User\Password;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Laracasts\Flash\Flash;
use PWWEB\Core\Repositories\User\Password\HistoryRepository;
use PWWEB\Core\Requests\User\Password\CreateHistoryRequest;
use PWWEB\Core\Requests\User\Password\UpdateHistoryRequest;

/**
 * PWWEB\Core\User\Password\HistoryController HistoryController.
 *
 * The CRUD controller for History
 * Class HistoryController
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class HistoryController extends Controller
{
    /**
     * Repository of Historic Passwords to be used throughout the controller.
     *
     * @var HistoryRepository
     */
    private $historyRepository;

    /**
     * Constructor for the Historic Password controller.
     *
     * @param HistoryRepository $historyRepo Repository of Historic Passwords.
     *
     * @return void
     */
    public function __construct(HistoryRepository $historyRepo)
    {
        $this->historyRepository = $historyRepo;
    }

    /**
     * Display a listing of the History.
     *
     * @param Request $request Request containing the information for filtering.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request): View
    {
        $histories = $this->historyRepository->all();

        return view('user.password.histories.index')
            ->with('histories', $histories);
    }

    /**
     * Show the form for creating a new History.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('user.password.histories.create');
    }

    /**
     * Store a newly created History in storage.
     *
     * @param CreateHistoryRequest $request Request containing the information to be stored.
     *
     * @return RedirectResponse
     */
    public function store(CreateHistoryRequest $request): RedirectResponse
    {
        $input = $request->all();

        $history = $this->historyRepository->create($input);

        if (false === empty($history)) {
            Flash::success('History saved successfully.');
        } else {
            Flash::error('History could not be saved.');
        }

        return redirect(route('user.password.histories.index'));
    }

    /**
     * Display the specified History.
     *
     * @param int $id ID of the Historic Password to be displayed. Used for retrieving currently held data.
     *
     * @return View|RedirectResponse
     */
    public function show($id)
    {
        $history = $this->historyRepository->find($id);

        if (true === empty($history)) {
            Flash::error('History not found');

            return redirect(route('user.password.histories.index'));
        }

        return view('user.password.histories.show')->with('history', $history);
    }

    /**
     * Show the form for editing the specified History.
     *
     * @param int $id ID of the Historic Password to be edited. Used for retrieving currently held data.
     *
     * @return View|RedirectResponse
     */
    public function edit($id)
    {
        $history = $this->historyRepository->find($id);

        if (true === empty($history)) {
            Flash::error('History not found');

            return redirect(route('user.password.histories.index'));
        }

        return view('user.password.histories.edit')->with('history', $history);
    }

    /**
     * Update the specified History in storage.
     *
     * @param int                  $id      ID of the Historic Password to be updated.
     * @param UpdateHistoryRequest $request Request containing the information to be updated.
     *
     * @return RedirectResponse
     */
    public function update($id, UpdateHistoryRequest $request): RedirectResponse
    {
        $history = $this->historyRepository->find($id);

        if (true === empty($history)) {
            Flash::error('History not found');

            return redirect(route('core.user.password.histories.index'));
        }

        $history = $this->historyRepository->update($request->all(), $id);

        if (false === empty($history)) {
            Flash::success('History updated successfully.');
        } else {
            Flash::error('History could not be updated.');
        }

        return redirect(route('core.user.password.histories.index'));
    }

    /**
     * Remove the specified History from storage.
     *
     * @param int $id ID of the Historic Password to be destroyed.
     *
     * @throws \Exception
     *
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $history = $this->historyRepository->find($id);

        if (true === empty($history)) {
            Flash::error('History not found');

            return redirect(route('core.user.password.histories.index'));
        }

        $this->historyRepository->delete($id);

        Flash::success('History deleted successfully.');

        return redirect(route('core.user.password.histories.index'));
    }
}
