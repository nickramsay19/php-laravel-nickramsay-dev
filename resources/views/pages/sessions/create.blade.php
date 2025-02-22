<x-layout title="Login">
    <x-form method="POST" :action="route('sessions.store')">
        <x-form.input-group name="name" label="Username" />
        <x-form.input-group name="password" type="password" label="Password" />
        <x-form.input-group type="submit" value="Login" />
    </x-form>
</x-layout>