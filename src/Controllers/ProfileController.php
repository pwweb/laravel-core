<?php

namespace PWWEB\Core\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use PWWEB\Core\Enums\Gender;
use PWWEB\Core\Enums\Title;
use PWWEB\Core\Models\User;
use PWWEB\Core\Requests\Profile\UpdateAvatarRequest as ValidatedAvatarRequest;
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
     * The currently logged in User.
     *
     * @var User
     */
    private $user = null;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the profile page for the logged in user.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        if (($user = \Auth::user()) instanceof User) {
            $profile = User::with('person')->findOrFail($user->id);

            return view('system.profile.index', compact('profile'));
        }
    }

    /**
     * Resend the verification email if the account has not yet been verified.
     *
     * @return \Illuminate\Http\RedirectResponse
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
     * @return \Illuminate\View\View
     */
    public function edit(): View
    {
        if (($user = \Auth::user()) instanceof User) {
            $profile = User::with('person')->findOrFail($user->id);
            $genders = Gender::getAll();
            $titles = Title::getAll();

            return view('system.profile.edit', compact('profile', 'genders', 'titles'));
        }
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
     * Update the specified resource in storage.
     *
     * @param \PWWEB\Core\Requests\Profile\UpdateAvatarRequest $request validated changes to apply
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAvatar(ValidatedAvatarRequest $request): RedirectResponse
    {
        if (($user = \Auth::user()) instanceof User) {
            $validated = $request->validated();

            $updatedUser = User::where('id', $user->id)->first();

            if (true === $request->hasFile('avatar') && true === $request->file('avatar')->isValid()) {
                $updatedUser->person->addMediaFromRequest('avatar')->toMediaCollection('avatars');
            }

            $updatedUser->person->save();
            $updatedUser->save();
        }

        return redirect()->route('system.profile.index');
    }
}
