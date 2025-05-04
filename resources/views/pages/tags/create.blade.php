<x-layout title="Create">
    <x-form method="POST" :action="route('tags.store')">
        <x-input name="name" label="Tag" placeholder="tag-name" class="mt-2" inline />
        <x-input type="submit" value="Save" class="mt-2" inline />
    </x-form>
</x-layout>