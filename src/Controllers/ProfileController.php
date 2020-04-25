<?php

namespace PWWEB\Core\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\View\View;
use PWWEB\Core\Enums\Gender;
use PWWEB\Core\Enums\Title;
use PWWEB\Core\Models\Person;
use PWWEB\Core\Models\User;
use PWWEB\Core\Requests\Profile\UpdateAvatarRequest as ValidatedAvatarRequest;
use PWWEB\Core\Requests\UpdateProfileRequest as ValidatedRequest;

/**
 * PWWEB\Core\Controllers\Profile Controller.
 *
 * Standard controller for profile management.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class ProfileController extends Controller
{
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
        if (\Auth::user() instanceof Authenticatable) {
            $profile = User::with('person')->findOrFail(\Auth::user()->id);

            return view('system.profile.index', compact('profile'));
        }
    }

    /**
     * Show the profile edit form.
     *
     * @return \Illuminate\View\View
     */
    public function edit(): View
    {
        if (\Auth::user() instanceof Authenticatable) {
            $profile = User::with('person')->findOrFail(\Auth::user()->id);
            $genders = Gender::getAll();
            $titles = Title::getAll();

            return view('system.profile.edit', compact('profile', 'genders', 'titles'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\ValidatedPerson $request validated data
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($request): RedirectResponse
    {
        $validated = $request->validated();
        if (true === $validated) {
            // $person = new Person();
            // $person->save();
            return redirect()->route('system.profile.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\System\Profile $request validated changes to apply
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ValidatedRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = User::where('id', \Auth::user()->id)->first();
        $user->person->title = $validated['title'];
        $user->person->name = $validated['name'];
        $user->person->middle_name = $validated['middle_name'];
        $user->person->surname = $validated['surname'];
        $user->person->maiden_name = $validated['maiden_name'];
        $user->person->dob = $validated['dob'];
        $user->person->gender = $validated['gender'];
        $user->person->save();
        $user->save();

        return redirect()->route('system.profile.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\System\Profile\Avatar $request validated changes to apply
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAvatar(ValidatedAvatarRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = User::where('id', \Auth::user()->id)->first();

        if (true === $request->hasFile('avatar') && true === $request->file('avatar')->isValid()) {
            $user->person->addMediaFromRequest('avatar')->toMediaCollection('avatars');
        }

        $user->person->save();
        $user->save();

        return redirect()->route('system.profile.index');
    }
}
