<x-layout title="Roles">
    <div class="flex flex-col divide divide-x divide-y divide-blue-500 divide-x-dark-epsilon">
        <div class="grid grid-cols-4 w-full border border-dark-epsilon divide-x divide-dark-epsilon *:p-1 *:text-lg *:text-center">
            <div>Role</div>
            <div>Permissions</div>
            <div>Users</div>
            <div>Managers</div>
        </div>
        @foreach ($roles as $role)
            <div class="grid grid-cols-4 w-full border border-dark-epsilon divide-x divide-dark-epsilon *:p-1">
                <div>{{ $role->name }}</div>
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