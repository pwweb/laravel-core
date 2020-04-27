<?php

namespace PWWEB\Core\Controllers;

use App\Http\Controllers\Controller;
use Flash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use PWWEB\Core\Repositories\UserRepository;
use PWWEB\Core\Requests\CreateUserRequest;
use PWWEB\Core\Requests\UpdateUserRequest;

/**
 * PWWEB\Core\Controllers\UserController UserController.
 *
 * The CRUD controller for User
 * Class UserController
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class UserController extends Controller
{
    /**
     * Repository of users to be used throughout the controller.
     *
     * @var \PWWEB\Core\Repositories\UserRepository
     */
    private $userRepository;

    /**
     * Constructor for the User controller.
     *
     * @param UserRepository $userRepo Repository of Users.
     */
    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request Request for the user list / index.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request): View
    {
        $users = $this->userRepository->all();

        return view('core::users.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('core::users.create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request Request for the user creation.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateUserRequest $request): RedirectResponse
    {
        $input = $request->all();

        $user = $this->userRepository->create($input);

        Flash::success('User saved successfully.');

        return redirect(route('core.users.index'));
    }

    /**
     * Display the specified User.
     *
     * @param int $id ID of the user to be displayed.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);

        if (true === empty($user)) {
            Flash::error('User not found');

            return redirect(route('core.users.index'));
        }

        return view('core::users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id ID of the user to be edited.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);

        if (true === empty($user)) {
            Flash::error('User not found');

            return redirect(route('core.users.index'));
        }

        return view('core::users.edit')->with('user', $user);
    }

    /**
     * Update the specified User in storage.
     *
     * @param int               $id      ID of the user to be updated.
     * @param UpdateUserRequest $request Request for the user update.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UpdateUserRequest $request): RedirectResponse
    {
        $user = $this->userRepository->find($id);

        if (true === empty($user)) {
            Flash::error('User not found');

            return redirect(route('core.users.index'));
        }

        $user = $this->userRepository->update($request->all(), $id);

        Flash::success('User updated successfully.');

        return redirect(route('core.users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param int $id ID of the user to be deleted.
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $user = $this->userRepository->find($id);

        if (true === empty($user)) {
            Flash::error('User not found');

            return redirect(route('core.models.users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('User deleted successfully.');

        return redirect(route('pWWEB.core.models.users.index'));
    }
}
