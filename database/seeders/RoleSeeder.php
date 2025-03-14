<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use App\Models\Post;
use App\Models\Tag;

class RoleSeeder extends Seeder {
    public function run(): void {
        $createPosts = Permission::updateOrCreate(['name' => 'create_posts'])->id;
        $updatePosts = Permission::updateOrCreate(['name' => 'update_posts'])->id;
        $deletePosts = Permission::updateOrCreate(['name' => 'delete_posts'])->id;
        $restorePosts = Permission::updateOrCreate(['name' => 'restore_posts'])->id;
        $forceDeletePosts = Permission::updateOrCreate(['name' => 'force_delete_posts'])->id;
        $updateOwnPosts = Permission::updateOrCreate(['name' => 'update_own_posts'])->id;
        $deleteOwnPosts = Permission::updateOrCreate(['name' => 'delete_own_posts'])->id;
        $viewUnpublishedPosts = Permission::updateOrCreate(['name' => 'view_unpublished_posts'])->id;

        $createRoles = Permission::updateOrCreate(['name' => 'create_roles'])->id;
        $updateRoles = Permission::updateOrCreate(['name' => 'update_roles'])->id;
        $deleteRoles = Permission::updateOrCreate(['name' => 'delete_roles'])->id;
        $restoreRoles = Permission::updateOrCreate(['name' => 'restore_roles'])->id;
        $forceDeleteRoles = Permission::updateOrCreate(['name' => 'force_delete_roles'])->id;

        Role::updateOrCreate(['name' => 'admin'])->permissions()->sync(Permission::all()->pluck('id'));

        $author = Role::updateOrCreate(['name' => 'author'])->permissions()->sync([
            $createPosts,
            $updateOwnPosts,
        ]);
    }
}