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
}