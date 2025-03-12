<x-layout title="Login">
    <x-form method="POST" :action="route('sessions.store')">
        <x-form.input-group name="name" label="Username" inline class="mt-2" />
        <x-form.input-group name="password" type="password" label="Password" inline class="mt-2" />
        <x-form.input-group type="submit" value="Login" inline class="mt-2" />
    </x-form>
</x-layout>