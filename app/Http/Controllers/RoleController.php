<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;

use App\Models\Role;
use App\Models\User;
use App\Requests\StoreRoleRequest;
use App\Requests\UpdateRoleRequest;

class RoleController extends Controller {
    public function index() {
        Gate::authorize('viewAny', Role::class);

        return view('pages.roles.index', [
            'roles' => Role::with(['users', 'permissions', 'managers'])->get(),
        ]);
    }

    public function show(?Role $role) {
        Gate::authorize('view', $role);

        return view('pages.roles.show', [
            'role' => $role,
        ]);
    }

    public function create() {
        Gate::authorize('create', Role::class);

        return view('pages.roles.create');
    }

    public function store(StoreRoleRequest $request) {
        Gate::authorize('create', Role::class);

        $role = Role::create([
            'name' => $request->safe()->name,
        ]);

        return response($post)->header('HX-Redirect', route('roles.show', $role->name));
    }

    public function edit(Role $role) {
        Gate::authorize('update', $role);
        
        return view('pages.roles.edit', [
            'role' => $role,
        ]);
    }

    public function update(UpdateRoleRequest $request, Role $role) {
        Gate::authorize('update', $role);

        $request->whenHas('name', function ($name) use ($role) {
            $role->update(['name' => $name]);
        });

        $request->whenHas('permissions', function ($permissions) use ($role) {
            $role->permissions()->sync(Permission::whereIn('name', $permissions)->pluck('id'));
        });

        $request->whenHas('users', function ($users) use ($role) {
            $role->users()->sync(User::whereIn('name', $users)->pluck('id'));
        });

        return response($role)->header('HX-Redirect', route('roles.show', $role->name));
    }

    public function destroy(Role $role) {
        Gate::authorize('delete', $role);
        return response($post)->header('HX-Redirect', route('roles'));
    }
}