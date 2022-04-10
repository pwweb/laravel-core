<?php

namespace PWWEB\Core\Controllers\Tax;

use App\Http\Controllers\Controller;
use Flash;
use Illuminate\Http\Request;
use PWWEB\Core\Enums\Tax\Type;
use PWWEB\Core\Interfaces\Tax\RateRepositoryInterface;
use PWWEB\Core\Requests\Tax\CreateRateRequest;
use PWWEB\Core\Requests\Tax\UpdateRateRequest;

/**
 * PWWEB\Core\Controllers\Tax\RateController RateController.
 *
 * The CRUD controller for Rate
 * Class RateController
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class RateController extends Controller
{
    /**
     * Repository of rates to be used throughout the controller.
     *
     * @var \PWWEB\Core\Interfaces\Tax\RateRepositoryInterface
     */
    private $rateRepository;

    /**
     * Constructor for the Rate controller.
     *
     * @param  RateRepositoryInterface  $rateRepo  Repository of Rates.
     */
    public function __construct(RateRepositoryInterface $rateRepo)
    {
        $this->rateRepository = $rateRepo;
    }

    /**
     * Display a listing of the Rate.
     *
     * @param  Request  $request  Index request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $rates = $this->rateRepository->paginate(15);

        return view('core::tax.rates.index')
            ->with('rates', $rates);
    }

    /**
     * Show the form for creating a new Rate.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $types = Type::getAll();

        return view('core::tax.rates.create', compact('types'));
    }

    /**
     * Store a newly created Rate in storage.
     *
     * @param  CreateRateRequest  $request  Create Request
     * @return \Illuminate\View\View
     */
    public function store(CreateRateRequest $request)
    {
        $input = $request->all();

        $rate = $this->rateRepository->create($input);

        Flash::success(__('pwweb::core.tax.rates.saved'));

        return redirect(route('core.tax.rates.index'));
    }

    /**
     * Display the specified Rate.
     *
     * @param  int  $id  ID to show
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $rate = $this->rateRepository->find($id);
        $rate->type = Type::make($rate->type);

        if (true === empty($rate)) {
            Flash::error(__('pwweb::core.tax.rates.not_found'));

            return redirect(route('core.tax.rates.index'));
        }

        return view('core::tax.rates.show')->with('rate', $rate);
    }

    /**
     * Show the form for editing the specified Rate.
     *
     * @param  int  $id  ID to edit
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $rate = $this->rateRepository->find($id);
        $types = Type::getAll();

        if (true === empty($rate)) {
            Flash::error(__('pwweb::core.tax.rates.not_found'));

            return redirect(route('core.tax.rates.index'));
        }

        return view('core::tax.rates.edit', compact('rate', 'types'));
    }

    /**
     * Update the specified Rate in storage.
     *
     * @param  int  $id  ID to update
     * @param  UpdateRateRequest  $request  Edit Request
     * @return \Illuminate\View\View
     */
    public function update($id, UpdateRateRequest $request)
    {
        $rate = $this->rateRepository->find($id);

        if (true === empty($rate)) {
            Flash::error(__('pwweb::core.tax.rates.not_found'));

            return redirect(route('core.tax.rates.index'));
        }

        $rate = $this->rateRepository->update($request->all(), $id);

        Flash::success(__('pwweb::core.tax.rates.updated'));

        return redirect(route('core.tax.rates.index'));
    }

    /**
     * Remove the specified Rate from storage.
     *
     * @param  int  $id  ID to destroy
     * @return \Illuminate\View\View
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $rate = $this->rateRepository->find($id);

        if (true === empty($rate)) {
            Flash::error(__('pwweb::core.tax.rates.not_found'));

            return redirect(route('core.tax.rates.index'));
        }

        $this->rateRepository->delete($id);

        Flash::success(__('pwweb::core.tax.rates.deleted'));

        return redirect(route('core.tax.rates.index'));
    }
}
