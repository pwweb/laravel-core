<?php

namespace App\Http\Controllers\User\Password;

use App\Http\Requests\User\Password\CreateHistoryRequest;
use App\Http\Requests\User\Password\UpdateHistoryRequest;
use App\Repositories\User\Password\HistoryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

/**
 * App\Http\Controllers\User\Password\HistoryController HistoryController
 *
 * The CRUD controller for History
 * Class HistoryController
 *
 * @package   pwweb/localisation
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
*/
class HistoryController extends AppBaseController
{
    /** @var  HistoryRepository */
    private $historyRepository;

    public function __construct(HistoryRepository $historyRepo)
    {
        $this->historyRepository = $historyRepo;
    }

    /**
     * Display a listing of the History.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $histories = $this->historyRepository->all();

        return view('user.password.histories.index')
            ->with('histories', $histories);
    }

    /**
     * Show the form for creating a new History.
     *
     * @return Response
     */
    public function create()
    {
        return view('user.password.histories.create');
    }

    /**
     * Store a newly created History in storage.
     *
     * @param CreateHistoryRequest $request
     *
     * @return Response
     */
    public function store(CreateHistoryRequest $request)
    {
        $input = $request->all();

        $history = $this->historyRepository->create($input);

        Flash::success('History saved successfully.');

        return redirect(route('user.password.histories.index'));
    }

    /**
     * Display the specified History.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $history = $this->historyRepository->find($id);

        if (empty($history)) {
            Flash::error('History not found');

            return redirect(route('user.password.histories.index'));
        }

        return view('user.password.histories.show')->with('history', $history);
    }

    /**
     * Show the form for editing the specified History.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $history = $this->historyRepository->find($id);

        if (empty($history)) {
            Flash::error('History not found');

            return redirect(route('user.password.histories.index'));
        }

        return view('user.password.histories.edit')->with('history', $history);
    }

    /**
     * Update the specified History in storage.
     *
     * @param int $id
     * @param UpdateHistoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHistoryRequest $request)
    {
        $history = $this->historyRepository->find($id);

        if (empty($history)) {
            Flash::error('History not found');

            return redirect(route('user.password.histories.index'));
        }

        $history = $this->historyRepository->update($request->all(), $id);

        Flash::success('History updated successfully.');

        return redirect(route('user.password.histories.index'));
    }

    /**
     * Remove the specified History from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $history = $this->historyRepository->find($id);

        if (empty($history)) {
            Flash::error('History not found');

            return redirect(route('user.password.histories.index'));
        }

        $this->historyRepository->delete($id);

        Flash::success('History deleted successfully.');

        return redirect(route('user.password.histories.index'));
    }
}
