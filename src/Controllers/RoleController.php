<?php

namespace PWWEB\Core\Controllers;

use App\Http\Controllers\Controller;
use Flash;
use Illuminate\Http\Request;
use PWWEB\Core\Interfaces\PermissionRepositoryInterface;
use PWWEB\Core\Interfaces\RoleRepositoryInterface;
use PWWEB\Core\Requests\CreateRoleRequest;
use PWWEB\Core\Requests\UpdateRoleRequest;

/**
 * PWWEB\Core\Controllers\RoleController RoleController.
 *
 * The CRUD controller for Role
 * Class RoleController
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class RoleController extends Controller
{
    /**
     * Repository of Roles to be used throughout the controller.
     *
     * @var RoleRepositoryInterface
     */
    private $roleRepository;

    /**
     * Repository of Permissions to be used throughout the controller.
     *
     * @var PermissionRepositoryInterface
     */
    private $permissionRepository;

    /**
     * Constructor for the Role controller.
     *
     * @param RoleRepositoryInterface $roleRepo Repository of Roles.
     * @param PermissionRepositoryInterface $permissionRepo Repository of Permissions.
     */
    public function __construct(
        RoleRepositoryInterface $roleRepo,
        PermissionRepositoryInterface $permissionRepo
    ) {
        $this->roleRepository = $roleRepo;
        $this->permissionRepository = $permissionRepo;
    }

    /**
     * Display a listing of Roles.
     *
     * @param Request $request Request containing the information for filtering.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $roles = $this->roleRepository->all()->filter(function ($value, $key) {
            return 'Admin' !== $value->name;
        });
        $permissions = $this->permissionRepository->all();
        $abilities = config('pwweb.core.permission.abilities');

        return view('core::roles.index', compact('roles', 'permissions', 'abilities'));
    }

    /**
     * Show the form for creating a new Role.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('core::roles.create');
    }

    /**
     * Store a newly created Role in storage.
     *
     * @param CreateRoleRequest $request Request containing the information to be stored.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateRoleRequest $request)
    {
        $input = $request->all();

        $role = $this->roleRepository->create($input);

        Flash::success('Role saved successfully.');

        return redirect(route('core.roles.index'));
    }

    /**
     * Display the specified Role.
     *
     * @param int $id ID of the Role to be displayed. Used for retrieving currently held data.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    // public function show($id)
    // {
    //     $role = $this->roleRepository->find($id);
    //
    //     if (true === empty($role)) {
    //         Flash::error('Role not found');
    //
    //         return redirect(route('core.roles.index'));
    //     }
    //
    //     return view('core::roles.show')->with('role', $role);
    // }

    /**
     * Show the form for editing the specified Role.
     *
     * @param int $id ID of the Role to be edited. Used for retrieving currently held data.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    // public function edit($id)
    // {
    //     $role = $this->roleRepository->find($id);
    //
    //     if (true === empty($role)) {
    //         Flash::error('Role not found');
    //
    //         return redirect(route('core.roles.index'));
    //     }
    //
    //     return view('core::roles.edit')->with('role', $role);
    // }

    /**
     * Update the specified Role in storage.
     *
     * @param int                  $id      ID of the Role to be updated.
     * @param UpdateRoleRequest $request Request containing the information to be updated.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UpdateRoleRequest $request)
    {
        $role = $this->roleRepository->find($id);

        if (true === empty($role)) {
            Flash::error('Role not found');

            return redirect(route('core.roles.index'));
        }

        if ('Admin' === $role->name) {
            $role->syncPermissions($this->permissionRepository->all());

            return redirect(route('core.roles.index'));
        }

        $permissions = $request->get('permissions', []);

        $role->syncPermissions($permissions);

        Flash::success('Role updated successfully.');

        return redirect(route('core.roles.index'));
    }

    /**
     * Remove the specified Role from storage.
     *
     * @param int $id ID of the Role to be destroyed.
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $role = $this->roleRepository->find($id);

        if (true === empty($role)) {
            Flash::error('Role not found');

            return redirect(route('core.roles.index'));
        }

        $this->roleRepository->delete($id);

        Flash::success('Role deleted successfully.');

        return redirect(route('core.roles.index'));
    }
}
