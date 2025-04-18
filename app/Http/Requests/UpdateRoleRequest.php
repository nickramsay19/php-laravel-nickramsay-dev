<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Http\FormRequest;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;

class StoreRoleRequest extends FormRequest {
    public function rules(): array {
        return [
            'name' => ['sometimes', 'string', 'lowercase', 'alpha_num:ascii', 'unique:roles,name', 'not_in:create', 'required_without_all:permissions,users'],
            'permissions' => ['sometimes', 'list', 'nullable', 'required_without_all:name,users'],
            'permissions.*' => ['string', 'exists:permissions,name'],
            'users' => ['sometimes', 'list', 'nullable', 'required_without_all:name,permissions'],
            'users.*' => ['string', 'exists:users,name'],
        ];
    }
}
