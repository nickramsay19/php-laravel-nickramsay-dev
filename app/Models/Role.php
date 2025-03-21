<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model {
    public function users(): BelongsToMany {
        return $this->belongsToMany(User::class, 'user_roles');
    }

    public function permissions(): BelongsToMany {
        return $this->belongsToMany(Permission::class, 'role_permissions');
    }

    public function managers(): BelongsToMany {
        return $this->belongsToMany(User::class, 'role_managers');
    }
}
