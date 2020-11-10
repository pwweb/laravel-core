<?php

namespace PWWEB\Core\Controllers\Tax;

use App\Http\Controllers\Controller;
use Flash;
use Illuminate\Http\Request;
use PWWEB\Core\Interfaces\CountryRepositoryInterface;
use PWWEB\Core\Interfaces\Tax\LocationRepositoryInterface;
use PWWEB\Core\Interfaces\Tax\RateRepositoryInterface;
use PWWEB\Core\Requests\Tax\CreateLocationRequest;
use PWWEB\Core\Requests\Tax\UpdateLocationRequest;
use Response;

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
class LocationController extends Controller
{
    /**
     * Repository of locations to be used throughout the controller.
     *
     * @var \PWWEB\Core\Interfaces\Tax\LocationRepositoryInterface
     */
    private $locationRepository;

    /**
     * Repository of rates to be used throughout the controller.
     *
     * @var \PWWEB\Core\Interfaces\Tax\RateRepositoryInterface
     */
    private $rateRepository;

    /**
     * Repository of addresses to be used throughout the controller.
     *
     * @var \PWWEB\Core\Interfaces\CountryRepositoryInterface
     */
    private $countryRepository;

    /**
     * Constructor for the Location controller.
     *
     * @param LocationRepositoryInterface $locationRepo Repository of Locations.
     * @param CountryRepositoryInterface  $countryRepo  Repository of Countries.
     * @param RateRepositoryInterface     $rateRepo     Repository of Rates.
     */
    public function __construct(LocationRepositoryInterface $locationRepo, CountryRepositoryInterface $countryRepo, RateRepositoryInterface $rateRepo)
    {
        $this->locationRepository = $locationRepo;
        $this->rateRepository = $rateRepo;
        $this->countryRepository = $countryRepo;
    }

    /**
     * Display a listing of the Location.
     *
     * @param Request $request Index Request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $locations = $this->locationRepository->paginate(15);

        return view('core::tax.locations.index')
            ->with('locations', $locations);
    }

    /**
     * Show the form for creating a new Location.
     *
     * @return Response
     */
    public function create()
    {
        $countries = $this->countryRepository->all();
        $rates = $this->rateRepository->all();

        return view('core::tax.locations.create', compact('countries', 'rates'));
    }

    /**
     * Store a newly created Location in storage.
     *
     * @param CreateLocationRequest $request Create Request
     *
     * @return Response
     */
    public function store(CreateLocationRequest $request)
    {
        $input = $request->all();

        $location = $this->locationRepository->create($input);

        Flash::success(__('pwweb::core.tax.locations.saved'));

        return redirect(route('core.tax.locations.index'));
    }

    /**
     * Display the specified Location.
     *
     * @param int $id ID to show
     *
     * @return Response
     */
    public function show($id)
    {
        $location = $this->locationRepository->find($id);

        if (true === empty($location)) {
            Flash::error(__('pwweb::core.tax.locations.not_found'));

            return redirect(route('core.tax.locations.index'));
        }

        return view('core::tax.locations.show')->with('location', $location);
    }

    /**
     * Show the form for editing the specified Location.
     *
     * @param int $id ID to edit
     *
     * @return Response
     */
    public function edit($id)
    {
        $location = $this->locationRepository->find($id);
        $countries = $this->countryRepository->all();
        $rates = $this->rateRepository->all();

        if (true === empty($location)) {
            Flash::error(__('pwweb::core.tax.locations.not_found'));

            return redirect(route('core.tax.locations.index'));
        }

        return view('core::tax.locations.edit', compact('location', 'countries', 'rates'));
    }

    /**
     * Update the specified Location in storage.
     *
     * @param int                   $id      ID to update
     * @param UpdateLocationRequest $request Update Request
     *
     * @return Response
     */
    public function update($id, UpdateLocationRequest $request)
    {
        $location = $this->locationRepository->find($id);

        if (true === empty($location)) {
            Flash::error(__('pwweb::core.tax.locations.not_found'));

            return redirect(route('core.tax.locations.index'));
        }

        $location = $this->locationRepository->update($request->all(), $id);

        Flash::success(__('pwweb::core.tax.locations.updated'));

        return redirect(route('core.tax.locations.index'));
    }

    /**
     * Remove the specified Location from storage.
     *
     * @param int $id ID to destroy
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $location = $this->locationRepository->find($id);

        if (true === empty($location)) {
            Flash::error(__('pwweb::core.tax.locations.not_found'));

            return redirect(route('core.tax.locations.index'));
        }

        $this->locationRepository->delete($id);

        Flash::success(__('pwweb::core.tax.locations.deleted'));

        return redirect(route('core.tax.locations.index'));
    }
}
