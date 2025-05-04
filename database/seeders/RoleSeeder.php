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
        $updateOwnPosts = Permission::updateOrCreate(['name' => 'update_own_posts'])->id;
        $deleteOwnPosts = Permission::updateOrCreate(['name' => 'delete_own_posts'])->id;
        $viewUnpublishedPosts = Permission::updateOrCreate(['name' => 'view_unpublished_posts'])->id;

        $createTags = Permission::updateOrCreate(['name' => 'create_tags'])->id;
        $updateTags = Permission::updateOrCreate(['name' => 'update_tags'])->id;
        $deleteTags = Permission::updateOrCreate(['name' => 'delete_tags'])->id;

        $viewRoles = Permission::updateOrCreate(['name' => 'view_roles'])->id;
        $createRoles = Permission::updateOrCreate(['name' => 'create_roles'])->id;
        $updateRoles = Permission::updateOrCreate(['name' => 'update_roles'])->id;
        $deleteRoles = Permission::updateOrCreate(['name' => 'delete_roles'])->id;

        $createUsers = Permission::updateOrCreate(['name' => 'create_users'])->id;
        $updateUsers = Permission::updateOrCreate(['name' => 'update_users'])->id;
        $deleteUsers = Permission::updateOrCreate(['name' => 'delete_users'])->id;

        Role::updateOrCreate(['name' => 'admin'])->permissions()->sync(Permission::all()->pluck('id'));

        $author = Role::updateOrCreate(['name' => 'author'])->permissions()->sync([
            $createPosts,
            $updateOwnPosts,
        ]);
    }
}