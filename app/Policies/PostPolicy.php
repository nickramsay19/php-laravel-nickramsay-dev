<?php

namespace App\Policies;

use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;

use App\Models\Post;
use App\Models\User;

class PostPolicy {
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Post $post): bool {
        if ($post->isPublished || $user?->id == $post->author_id) {
            return true;
        } else if (!$post->isPublished && $user?->id != $post->author_id) {
            return Auth::permissions()->contains('view_unpublished_posts');
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(?User $user): bool {
        return Auth::permissions()->contains('create_posts');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(?User $user, Post $post): bool {
        if ($user?->id == $post->author_id) {
            return Auth::permissions()->contains('update_own_posts');
        } 
        return Auth::permissions()->contains('update_posts');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(?User $user, Post $post): bool {
        if ($user?->id == $post->author_id) {
            return Auth::permissions()->contains('delete_own_posts');
        } 
        return Auth::permissions()->contains('delete_posts');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(?User $user, Post $post): bool {
        return Auth::permissions()->contains('restore_posts');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post): bool {
        return Auth::permissions()->contains('force_delete_posts');
    }
}
