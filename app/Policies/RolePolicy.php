<?php

namespace App\Policies;

use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;

use App\Models\Role;
use App\Models\User;

class RolePolicy {
    public function viewAny(?User $user): bool {
        return Auth::permissions()->contains('view_roles');
    }

    public function view(?User $user, Role $role): bool {
        return Auth::permissions()->contains('view_roles');
    }

    public function create(User $user): bool {
        return Auth::permissions()->contains('create_roles');
    }

    public function update(User $user, Role $role): bool {
        return Auth::permissions()->contains('update_roles');
    }

    public function delete(User $user, Role $role): bool {
        return Auth::permissions()->contains('delete_roles');
    }

    public function restore(User $user, Role $role): bool {
        return false;
    }

    public function forceDelete(User $user, Role $role): bool {
        return false;
    }
}
