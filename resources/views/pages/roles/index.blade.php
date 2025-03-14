<x-layout title="Roles">
    <div class="flex flex-col divide divide-x divide-y divide-blue-500 divide-x-dark-epsilon">
        <div class="grid grid-cols-4 w-full border border-dark-epsilon divide-x divide-dark-epsilon *:p-1 *:text-center">
            <div class="font-semibold">Role</div>
            <div class="font-semibold">Permissions</div>
            <div class="font-semibold">Users</div>
            <div class="font-semibold">Managers</div>
        </div>
        @foreach ($roles as $role)
            <div class="grid grid-cols-4 w-full border border-t-0 border-dark-epsilon divide-x divide-dark-epsilon *:p-1">
                <div>
                    <x-link href="/roles/{{ $role->name }}" class="font-semibold hover:underline">{{ $role->name }}</x-link>
                </div>
                <ul>
                    @foreach ($role->permissions as $permission)
                        <li>{{ $permission->name }}</li>
                    @endforeach
                </ul>
                <ul>
                    @foreach ($role->users as $user)
                        <li>{{ $user->name }}</li>
                    @endforeach
                </ul>
                <ul>
                    @foreach ($role->managers as $manager)
                        <li>{{ $manager->name }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</x-layout>