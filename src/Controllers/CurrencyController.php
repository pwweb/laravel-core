<?php

namespace PWWEB\Core\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use PWWEB\Core\Interfaces\CurrencyRepositoryInterface;
use PWWEB\Core\Requests\CreateCurrencyRequest;
use PWWEB\Core\Requests\UpdateCurrencyRequest;

/**
 * PWWEB\Core\Controllers\CurrencyController CurrencyController.
 *
 * The CRUD controller for Currency
 * Class CurrencyController
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class CurrencyController extends Controller
{
    /**
     * Repository of Currencies to be used throughout the controller.
     *
     * @var CurrencyRepositoryInterface
     */
    private $currencyRepository;

    /**
     * Constructor for the Currency controller.
     *
     * @param CurrencyRepositoryInterface $currencyRepo Repository of Currencies.
     */
    public function __construct(CurrencyRepositoryInterface $currencyRepo)
    {
        $this->currencyRepository = $currencyRepo;
    }

    /**
     * Display a listing of the Currency.
     *
     * @param Request $request Request containing the information for filtering.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $currencies = $this->currencyRepository->all();

        return view('core::currencies.index')
            ->with('currencies', $currencies);
    }

    /**
     * Show the form for creating a new Currency.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('core::currencies.create');
    }

    /**
     * Store a newly created Currency in storage.
     *
     * @param CreateCurrencyRequest $request Request containing the information to be stored.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateCurrencyRequest $request)
    {
        $input = $request->all();

        $currency = $this->currencyRepository->create($input);

        Flash::success('Currency saved successfully.');

        return redirect(route('core.currencies.index'));
    }

    /**
     * Display the specified Currency.
     *
     * @param int $id ID of the Currency to be displayed. Used for retrieving currently held data.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $currency = $this->currencyRepository->find($id);

        if (ture === empty($currency)) {
            Flash::error('Currency not found');

            return redirect(route('core.currencies.index'));
        }

        return view('core::currencies.show')->with('currency', $currency);
    }

    /**
     * Show the form for editing the specified Currency.
     *
     * @param int $id ID of the Currency to be edited. Used for retrieving currently held data.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $currency = $this->currencyRepository->find($id);

        if (true === empty($currency)) {
            Flash::error('Currency not found');

            return redirect(route('core.currencies.index'));
        }

        return view('core::currencies.edit')->with('currency', $currency);
    }

    /**
     * Update the specified Currency in storage.
     *
     * @param int                   $id      ID of the Currency to be updated.
     * @param UpdateCurrencyRequest $request Request containing the information to be updated.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UpdateCurrencyRequest $request)
    {
        $currency = $this->currencyRepository->find($id);

        if (true === empty($currency)) {
            Flash::error('Currency not found');

            return redirect(route('core.currencies.index'));
        }

        $currency = $this->currencyRepository->update($request->all(), $id);

        Flash::success('Currency updated successfully.');

        return redirect(route('core.currencies.index'));
    }

    /**
     * Remove the specified Currency from storage.
     *
     * @param int $id ID of the Country to be destroyed.
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $currency = $this->currencyRepository->find($id);

        if (true === empty($currency)) {
            Flash::error('Currency not found');

            return redirect(route('core.currencies.index'));
        }

        $this->currencyRepository->delete($id);

        Flash::success('Currency deleted successfully.');

        return redirect(route('core.currencies.index'));
    }
}
