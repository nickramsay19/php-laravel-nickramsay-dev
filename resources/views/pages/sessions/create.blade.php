<x-layout title="Login">
    <x-form method="POST" :action="route('sessions.store')">
        <x-form.input-group-inline name="name" label="Username" />
        <x-form.input-group-inline name="password" type="password" label="Password" />
        <x-form.input-group-inline type="submit" value="Login" />
    </x-form>
</x-layout>