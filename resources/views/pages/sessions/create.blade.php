<x-layout title="Login">
    <x-form method="POST" :action="route('sessions.store')">
        <x-input name="name" label="Username" class="mt-2" inline />
        <x-input name="password" type="password" label="Password" class="mt-2" inline />
        <x-input type="submit" value="Login" class="mt-2" inline />
    </x-form>
</x-layout>