<x-layout title="Create">
    <x-form method="POST" :action="route('images.store')">
        <x-input type="file" name="image" label="Image" class="mt-2" inline />
        <x-input type="submit" value="Create" class="mt-2" inline />
    </x-form>
</x-layout>