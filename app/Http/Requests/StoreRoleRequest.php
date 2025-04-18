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
            'name' => ['required', 'string', 'lowercase', 'alpha_num:ascii', 'unique:roles,name', 'not_in:create'],
            'permissions' => ['required', 'list', 'nullable'],
            'permissions.*' => ['string', 'exists:permissions,name'],
            'users' => ['required', 'list', 'nullable'],
            'users.*' => ['string', 'exists:users,name'],
        ];
    }
}
