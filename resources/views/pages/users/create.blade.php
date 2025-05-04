<x-layout title="Create">
    <x-form method="POST" :action="route('users.store')">
        <x-input type="email" name="email" label="Email" placeholder="name@email.com" class="mt-2" inline />
        <x-input type="text" name="name" label="Username" placeholder="bob123" class="mt-2" inline />
        <x-input type="password" name="password" label="Password" placeholder="******" class="mt-2" inline />
        <x-input type="submit" value="Save" class="mt-2" inline />
    </x-form>
</x-layout>