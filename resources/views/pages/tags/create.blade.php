<x-layout title="Create">
    <x-form method="POST" :action="route('tags.store')">
        <x-input name="name" label="Username" class="mt-2" inline />
        <x-input type="submit" value="Create" class="mt-2" inline />
    </x-form>
</x-layout>