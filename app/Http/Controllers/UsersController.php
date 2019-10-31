<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    private $userRepository;
    private $roleRepository;
    private $permissionRepository;

    public function __construct(UserRepository $userRepository, PermissionRepository $permissionRepository, RoleRepository $roleRepository) {
        $this->userRepository = $userRepository;
        $this->permissionRepository = $permissionRepository;
        $this->roleRepository = $roleRepository;
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'string|required|unique:users,username',
            'email' => 'string|required|unique:users,email',
            'names' => 'string|required',
            'password' => 'string|required',
            'paternal_surname' => 'string|required',
            'maternal_surname' => 'string|nullable',
            'age' => 'integer|nullable',
            'role' => 'integer|exists:roles,id',
            'permissions' => 'array|required',
        ]);

        $args = $request->only([
            'username',
            'email',
            'names',
            'paternal_surname',
            'maternal_surname',
            'age',
            'password',
            'role',
        ]);

        $inputPermissions = $request->permissions;
        $permissions = $this->getPermissions($inputPermissions);

        if (!$permissions) {
            return response()->json(['message' => 'invalid input data'], 422);
        }

        if (empty($inputPermissions)) {
            return response()->json(compact('At least one permission is required'), 422);
        }

        isset($args['maternal_surname']) ? : $args['maternal_surname'] = '';
        isset($args['age']) ? : $args['age'] = 1;

        $args['role_id'] =  $args['role'];
        $args['password'] = Hash::make($args['password']);
        $args['active'] = 1;

        DB::beginTransaction();
        $user = $this->userRepository::create($args);
        $user->permissions()->sync($permissions);
        DB::commit();

        return response()->json(compact(['user']), 201);
    }

    public function all()
    {
        $users = $this->userRepository->all();
        return response()->json($users, 200);
    }

    public function show(User $user)
    {
        return response()->json($user, 200);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'string|required|unique:users,username,' . $user->id,
            'email' => 'string|required|unique:users,email,' . $user->id,
            'names' => 'string|required',
            'password' => 'string|nullable',
            'paternal_surname' => 'string|required',
            'maternal_surname' => 'string|nullable',
            'age' => 'integer|nullable',
            'role' => 'integer|exists:roles,id',
            'active' => [
                'integer',
                'nullable',
                Rule::in([1, 0]),
            ],
            'permissions' => 'array|nullable',
        ]);

        $inputPermissions = $request->permissions;
        $permissions = [];

        if (isset($inputPermissions)) {
            $permissions = $this->getPermissions($inputPermissions);

            if (!$permissions) {
                return response()->json(['message' => 'invalid input data'], 422);
            }
        }

        isset($request->username) ? $user->username = $request->username : '';
        isset($request->email) ? $user->email = $request->email : '';
        isset($request->names) ? $user->names = $request->names : '';
        isset($request->paternal_surname) ? $user->paternal_surname = $request->paternal_surname : '';
        isset($request->maternal_surname) ? $user->maternal_surname = $request->maternal_surname : '';
        isset($request->age) ? $user->age = $request->age : '';
        isset($request->role) ? $user->role_id = $request->role : '';
        isset($request->active) ? $user->active = $request->active : '';
        
        if (isset($request->password)) {
            $user->password = Hash::make($request->password);
        }

        DB::beginTransaction();
        $user->save();

        if (!empty($permissions)) {
            $user->permissions()->sync($permissions);
        }
        DB::commit();

        return response()->json($user, 200);
    }

    public function destroy(User $user)
    {
        DB::beginTransaction();
        $user->permissions()->detach();
        $user->delete();
        DB::commit();
        return response()->json($user, 200);
    }

    public function byRol(Role $role)
    {
        $users = $role->users;

        return response()->json(compact('users'), 200);

    }

    public function byActive($active)
    {
        $users = $this->userRepository->active($active != 0 ? 1 : 0)->get();

        return response()->json(compact('users'), 200);

    }

    public function byPermission(Permission $permission)
    {
        $users = $permission->users;

        return response()->json(compact('users'), 200);
    }

    public function getPermissions($inputs)
    {
        $permissions = [];

        foreach ($inputs as $key => $permission) {
            if (!$this->permissionRepository->find($permission)) {
                return [];
            }

            array_push($permissions, $permission);
        }

        return $permissions;
    }
}
