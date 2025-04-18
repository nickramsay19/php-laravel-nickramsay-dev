<x-layout title="Create">
    <x-form method="POST" :action="route('roles.store')">
        <x-input name="name" label="Role" placeholder="name-of-role" class="mt-2" inline />

        <x-input.select name="permission" class="my-2" multiple>
            <option disabled>Permissions:</option>
            @foreach (\App\Models\Permission::all()->pluck('name') as $permission)
                <option value="{{ $permission }}">{{ $permission }}</option>
            @endforeach
        </x-input.select>

        <x-input.select name="users" class="my-2" multiple>
            <option disabled>Users:</option>
            @foreach (\App\Models\User::all()->pluck('name') as $user)
                <option value="{{ $user }}">{{ $user }}</option>
            @endforeach
        </x-input.select>

        <hr class="text-dark-gamma" />

        <x-input type="submit" value="Create" class="mt-2" inline />
    </x-form>
</x-layout>