<?php

namespace PWWEB\Core\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Laracasts\Flash\Flash;
use PWWEB\Core\Enums\Gender;
use PWWEB\Core\Enums\Title;
use PWWEB\Core\Exceptions\User\Password\HistoricPasswordNotAllowed;
use PWWEB\Core\Exceptions\User\Password\NotMatching;
use PWWEB\Core\Models\User;
use PWWEB\Core\Repositories\Address\TypeRepository;
use PWWEB\Core\Repositories\AddressRepository;
use PWWEB\Core\Repositories\CountryRepository;
use PWWEB\Core\Repositories\UserRepository;
use PWWEB\Core\Requests\CreateAddressRequest;
use PWWEB\Core\Requests\Profile\UpdateAvatarRequest as ValidatedAvatarRequest;
use PWWEB\Core\Requests\Profile\UpdatePasswordRequest as ValidatedPasswordRequest;
use PWWEB\Core\Requests\UpdateAddressRequest;
use PWWEB\Core\Requests\UpdateProfileRequest as ValidatedRequest;

/**
 * PWWEB\Core\Controllers\Profile Controller.
 *
 * Standard controller for profile management.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class ProfileController extends Controller
{
    /**
     * Repository of Users to be used throughout the controller.
     *
     * @var UserRepository
     */
    private $userRepository;

    /**
     * Repository of Addresses to be used throughout the controller.
     *
     * @var AddressRepository
     */
    private $addressRepository;

    /**
     * Repository of Countries to be used throughout the controller.
     *
     * @var CountryRepository
     */
    private $countryRepository;

    /**
     * Repository of Address Types to be used throughout the controller.
     *
     * @var TypeRepository
     */
    private $typeRepository;

    /**
     * Create a new controller instance.
     *
     * @param UserRepository    $userRepo    Repository of Users.
     * @param AddressRepository $addressRepo Repository of Addresses.
     * @param CountryRepository $countryRepo Repository of Countries.
     * @param TypeRepository    $typeRepo    Repository of Address Types.
     *
     * @return void
     */
    public function __construct(
        UserRepository $userRepo,
        AddressRepository $addressRepo,
        CountryRepository $countryRepo,
        TypeRepository $typeRepo
    ) {
        $this->userRepository = $userRepo;
        $this->addressRepository = $addressRepo;
        $this->countryRepository = $countryRepo;
        $this->typeRepository = $typeRepo;
    }

    /**
     * Show the profile page for the logged in user.
     *
     * @return View|RedirectResponse
     */
    public function index()
    {
        if (($user = \Auth::user()) instanceof User) {
            $profile = $this->userRepository->find($user->id);

            return view('system.profile.index', compact('profile'));
        }

        return redirect()->back();
    }

    /**
     * Show a person's profile page.
     *
     * @param string|int $user The user ID or username.
     *
     * @return View|RedirectResponse
     */
    public function show($user)
    {
        if (true === is_numeric($user)) {
            $person = $this->userRepository->find((int) $user);
        } else {
            $person = $this->userRepository->findByUsername($user);
        }

        if (true === empty($person)) {
            Flash::error('Person not found');

            return redirect(route('system.profile.public'));
        }

        return view('system.profile.public')
            ->with('profile', $person);
    }

    /**
     * Resend the verification email if the account has not yet been verified.
     *
     * @return RedirectResponse
     */
    public function reverify(): RedirectResponse
    {
        if (($user = \Auth::user()) instanceof User) {
            if (false === $user->hasVerifiedEmail()) {
                $user->sendEmailVerificationNotification();
            }
        }

        return redirect()->route('system.profile.index');
    }

    /**
     * Show the profile edit form.
     *
     * @return View|RedirectResponse
     */
    public function edit()
    {
        if (($user = \Auth::user()) instanceof User) {
            $profile = User::with('person')->findOrFail($user->id);
            $genders = Gender::getAll();
            $titles = Title::getAll();

            return view('system.profile.edit', compact('profile', 'genders', 'titles'));
        }

        return redirect()->back();
    }

    /**
     * Show the profile edit form.
     *
     * @param int|string|User $recipient Recipient of friend request.
     *
     * @return RedirectResponse
     */
    public function befriend($recipient)
    {
        if (true === is_numeric($recipient)) {
            $recipient = $this->userRepository->find((int) $recipient);
        } else {
            $recipient = $this->userRepository->findByUsername((string) $recipient);
        }

        if (($user = \Auth::user()) instanceof User && $recipient instanceof User) {
            $user->befriend($recipient);
        }

        return redirect()->back();
    }

    /**
     * Show the password change form.
     *
     * @return \Illuminate\View\View
     */
    public function password(): View
    {
        return view('system.profile.password');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param object $request validated data
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($request): ?RedirectResponse
    {
        return redirect()->route('system.profile.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \PWWEB\Core\Requests\UpdateProfileRequest $request validated changes to apply
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ValidatedRequest $request): RedirectResponse
    {
        if (($user = \Auth::user()) instanceof User) {
            $validated = $request->validated();

            $updatedUser = User::where('id', $user->id)->first();
            $updatedUser->person->title = $validated['title'];
            $updatedUser->person->name = $validated['name'];
            $updatedUser->person->middle_name = $validated['middle_name'];
            $updatedUser->person->surname = $validated['surname'];
            $updatedUser->person->maiden_name = $validated['maiden_name'];
            $updatedUser->person->dob = $validated['dob'];
            $updatedUser->person->gender = $validated['gender'];
            $updatedUser->person->save();
            $updatedUser->save();
        }

        return redirect()->route('system.profile.index');
    }

    /**
     * Update the password for the user.
     *
     * @param ValidatedPasswordRequest $request Validated changes to apply
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(ValidatedPasswordRequest $request): RedirectResponse
    {
        if (($user = \Auth::user()) instanceof User) {
            $validated = $request->validated();

            try {
                $this->userRepository->changePassword($user->id, $validated);

                Flash::success('New password set.');
            } catch (NotMatching $e) {
                Flash::error($e->getMessage());

                return redirect()->route('system.profile.password');
            } catch (HistoricPasswordNotAllowed $e) {
                Flash::error($e->getMessage());

                return redirect()->route('system.profile.password');
            }
        }

        return redirect()->route('system.profile.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \PWWEB\Core\Requests\Profile\UpdateAvatarRequest $request validated changes to apply
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAvatar(ValidatedAvatarRequest $request): RedirectResponse
    {
        if (($user = \Auth::user()) instanceof User) {
            $request->validated();

            $updatedUser = User::where('id', $user->id)->first();

            if (true === $request->hasFile('avatar') && true === $request->file('avatar')->isValid()) {
                $updatedUser->person->addMediaFromRequest('avatar')->toMediaCollection('avatars');
            }

            $updatedUser->person->save();
            $updatedUser->save();
        }

        return redirect()->route('system.profile.index');
    }

    /**
     * Display the create view for addresses.
     *
     * @return View
     */
    public function createAddress(): View
    {
        $countries = $this->countryRepository->all();
        $types = $this->typeRepository->all();

        return view('core::profile.address.create')
            ->with('types', $types)
            ->with('countries', $countries);
    }

    /**
     * Store and assign a newly created Address.
     *
     * @param CreateAddressRequest $request Request containing the information to be stored.
     *
     * @return RedirectResponse
     */
    public function storeAddress(CreateAddressRequest $request): RedirectResponse
    {
        if (($user = \Auth::user()) instanceof User) {
            $input = $request->all();

            $address = $this->addressRepository->create($input);
            $user->person->assignAddress($address);

            Flash::success('Address saved successfully');
        }

        return redirect(route('system.profile.edit'));
    }

    /**
     * Update the specified Address in storage.
     *
     * @param int                  $id      ID of the Address to be updated.
     * @param UpdateAddressRequest $request Request containing the information to be updated.
     *
     * @return RedirectResponse
     */
    public function updateAddress($id, UpdateAddressRequest $request)
    {
        $address = $this->addressRepository->find($id);

        if (true === empty($address)) {
            Flash::error('Address not found');

            return redirect(route('system.profile.edit'));
        }

        $address = $this->addressRepository->update($request->all(), $id);

        if (false === empty($address)) {
            Flash::success('Address updated successfully.');
        } else {
            Flash::error('Address could not be updated.');
        }

        return redirect(route('system.profile.edit'));
    }
}
