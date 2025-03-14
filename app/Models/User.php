<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            //'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // utilities

    public function viewablePosts() {
        return Post::whereNotNull('published_at')
            ->orWhere('author_id', $this->id);
    }

    // relations

    public function posts() {
        return $this->hasMany(Post::class, 'author_id');
    }

    public function roles() {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function permissions() {
        return $this->belongsToMany(Permission::class, 'role_permissions', 'role_id', 'permission_id')
            ->distinct();
            //->join('user_roles', 'role_permissions.role_id', '=', 'user_roles.role_id')
            //->where('user_roles.user_id', $this->id);
    }
}
