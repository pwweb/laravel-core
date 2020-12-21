<?php

namespace PWWEB\Core\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use PWWEB\Core\Interfaces\Address\TypeRepositoryInterface;
use PWWEB\Core\Interfaces\AddressRepositoryInterface;
use PWWEB\Core\Interfaces\CountryRepositoryInterface;
use PWWEB\Core\Requests\CreateAddressRequest;
use PWWEB\Core\Requests\UpdateAddressRequest;

/**
 * PWWEB\Core\Controllers\AddressController AddressController.
 *
 * The CRUD controller for Address
 * Class AddressController
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class AddressController extends Controller
{
    /**
     * Repository of addresses to be used throughout the controller.
     *
     * @var \PWWEB\Core\Interfaces\AddressRepositoryInterface
     */
    private $addressRepository;

    /**
     * Repository of addresses to be used throughout the controller.
     *
     * @var \PWWEB\Core\Interfaces\CountryRepositoryInterface
     */
    private $countryRepository;

    /**
     * Repository of address types to be used throughout the controller.
     *
     * @var \PWWEB\Core\Interfaces\Address\TypeRepositoryInterface
     */
    private $typeRepository;

    /**
     * Constructor for the Address controller.
     *
     * @param AddressRepositoryInterface $addressRepo Repository of Addresses.
     * @param CountryRepositoryInterface $countryRepo Repository of Countries.
     * @param TypeRepositoryInterface    $typeRepo    Repository of Address types.
     */
    public function __construct(AddressRepositoryInterface $addressRepo, CountryRepositoryInterface $countryRepo, TypeRepositoryInterface $typeRepo)
    {
        $this->addressRepository = $addressRepo;
        $this->countryRepository = $countryRepo;
        $this->typeRepository = $typeRepo;
    }

    /**
     * Display a listing of the Address.
     *
     * @param Request $request Request containing the information for filtering.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $addresses = $this->addressRepository->all();

        return view('core::addresses.index')
            ->with('addresses', $addresses);
    }

    /**
     * Show the form for creating a new Address.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $types = $this->typeRepository->all();
        $countries = $this->countryRepository->all();

        return view('core::addresses.create')
            ->with('types', $types)
            ->with('countries', $countries);
    }

    /**
     * Store a newly created Address in storage.
     *
     * @param CreateAddressRequest $request Request containing the information to be stored.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateAddressRequest $request)
    {
        $input = $request->all();

        $address = $this->addressRepository->create($input);

        Flash::success('Address saved successfully.');

        return redirect(route('core.addresses.index'));
    }

    /**
     * Display the specified Address.
     *
     * @param int $id ID of the Address to be displayed. Used for retrieving currently held data.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $address = $this->addressRepository->find($id);

        if (true === empty($address)) {
            Flash::error('Address not found');

            return redirect(route('core.addresses.index'));
        }

        return view('core::addresses.show')->with('address', $address);
    }

    /**
     * Show the form for editing the specified Address.
     *
     * @param int $id ID of the Address to be edited. Used for retrieving currently held data.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $address = $this->addressRepository->find($id);
        $countries = $this->countryRepository->all();
        $types = $this->typeRepository->all();

        if (true === empty($address)) {
            Flash::error('Address not found');

            return redirect(route('core.addresses.index'));
        }

        return view('core::addresses.edit')
            ->with('address', $address)
            ->with('countries', $countries)
            ->with('types', $types);
    }

    /**
     * Update the specified Address in storage.
     *
     * @param int                  $id      ID of the Address to be updated.
     * @param UpdateAddressRequest $request Request containing the information to be updated.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UpdateAddressRequest $request)
    {
        $address = $this->addressRepository->find($id);

        if (true === empty($address)) {
            Flash::error('Address not found');

            return redirect(route('core.addresses.index'));
        }

        $this->addressRepository->update($request->all(), $id);

        Flash::success('Address updated successfully.');

        return redirect(route('core.addresses.index'));
    }

    /**
     * Remove the specified Address from storage.
     *
     * @param int $id ID of the Address to be destroyed.
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $address = $this->addressRepository->find($id);

        if (true === empty($address)) {
            Flash::error('Address not found');

            return redirect(route('core.addresses.index'));
        }

        $this->addressRepository->delete($id);

        Flash::success('Address deleted successfully.');

        return redirect(route('core.addresses.index'));
    }
}
