<?php

namespace PWWEB\Core\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Laracasts\Flash\Flash;
use PWWEB\Core\Interfaces\PersonRepositoryInterface;
use PWWEB\Core\Interfaces\RoleRepositoryInterface;
use PWWEB\Core\Interfaces\UserRepositoryInterface;
use PWWEB\Core\Requests\CreateUserRequest;
use PWWEB\Core\Requests\UpdateUserRequest;

/**
 * PWWEB\Core\Controllers\UserController UserController.
 *
 * The CRUD controller for User
 * Class UserController
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class UserController extends Controller
{
    /**
     * Repository of users to be used throughout the controller.
     *
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * Repository of persons to be used throughout the controller.
     *
     * @var PersonRepositoryInterface
     */
    private $personRepository;

    /**
     * Repository of roles to be used throughout the controller.
     *
     * @var RoleRepositoryInterface
     */
    private $roleRepository;

    /**
     * Constructor for the User controller.
     *
     * @param UserRepositoryInterface   $userRepo   Repository of Users.
     * @param PersonRepositoryInterface $personRepo Repository of Persons.
     * @param RoleRepositoryInterface   $roleRepo   Repository of Roles.
     */
    public function __construct(
        UserRepositoryInterface $userRepo,
        PersonRepositoryInterface $personRepo,
        roleRepositoryInterface $roleRepo
    ) {
        $this->userRepository = $userRepo;
        $this->personRepository = $personRepo;
        $this->roleRepository = $roleRepo;
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
        $roles = $this->roleRepository->pluck(['name', 'id']);

        return view('core::users.create', compact('roles'));
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
        $request->merge(['password' => \Hash::make($request->get('password'))]);
        $input = $request->all();

        \DB::beginTransaction();
        // First the person needs to be created.
        $person = $this->personRepository->create($input['person']);

        // Then the user is created.
        $user = $this->userRepository->create($input);

        // The person is assigned to the user.
        $assoc = $user->person()->associate($person)->save();

        // The user is associated with the role selected.
        $user->syncRoles($input['role_id']);

        \DB::commit();

        $user->sendEmailVerificationNotification();

        if (false === empty($assoc)) {
            Flash::success('User saved successfully.');
        } else {
            Flash::error('User could not be saved.');
        }

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
        $user = $this->userRepository->find($id, ['*'], ['roles']);
        $roles = $this->roleRepository->pluck(['name', 'id']);

        if (true === empty($user)) {
            Flash::error('User not found');

            return redirect(route('core.users.index'));
        }

        return view('core::users.edit')
            ->with('user', $user)
            ->with('roles', $roles);
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

        // Obtain the request data.
        $data = $request->all();

        // Password is only to be changed if it was supplied.
        if (null === $data['password']) {
            $data['password'] = $user->password;
        } else {
            $data['password'] = \Hash::make($data['password']);
        }

        $user = $this->userRepository->update($data, $id);

        // Create a corresponding person if the user does not have one and name and surname were provided.
        if (null === $user->person && null !== $data['person']['name'] && null !== $data['person']['surname']) {
            $person = $this->personRepository->create($data['person']);
            $assoc = $user->person()->associate($person)->save();
        } else {
            $this->personRepository->update($data['person'], $user->person->id);
        }

        // The user is associated with the role selected.
        $user->syncRoles($data['role_id']);

        if (true === isset($assoc) && false === $assoc) {
            Flash::warning('User partially updated.');
        } else {
            Flash::success('User updated successfully.');
        }

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

            return redirect(route('core.users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('User deleted successfully.');

        return redirect(route('core.users.index'));
    }
}
