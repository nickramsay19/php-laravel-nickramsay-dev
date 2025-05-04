<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class UserPolicy {
    public function viewAny(User $sessionUser): bool {
        return true;
    }

    public function view(User $sessionUser, User $user): bool {
        return true;
    }

    public function create(User $sessionUser): bool {
        return Auth::permissions()->contains('create_users');
    }

    public function update(User $sessionUser, User $user): bool {
        return Auth::permissions()->contains('update_users');
    }

    public function delete(User $sessionUser, User $user): bool {
        return Auth::permissions()->contains('delete_users');
    }

    public function restore(User $sessionUser, User $user): bool {
        return false;
    }

    public function forceDelete(User $sessionUser, User $user): bool {
        return false;
    }
}
