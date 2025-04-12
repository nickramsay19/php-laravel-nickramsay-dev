<x-layout title="Edit">
    <form hx-put="{{ route('tags.update', ['tag' => $tag]) }}" class="flex flex-col">
        <x-input name="name" type="text" label="name" placeholder="$tag-name" :value="$tag->name" required inline />

        <hr class="text-dark-gamma" />

        <div class="flex flex-row gap-2 mt-2">
            <button
                type="submit"
                class="bg-dark-beta hover:bg-accent border border-accent text-light cursor-pointer px-0.5"
            >
                Save
            </button>
        </div>
    </form>
</x-layout>