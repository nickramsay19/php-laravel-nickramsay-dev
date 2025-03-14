<x-layout title="Create">
    <form hx-post="{{ route('posts.store') }}" hx-ext='json-enc-custom' class="flex flex-col">
        
        <x-input name="title" type="text" label="Title" placeholder="Your post's title" required />

        <x-input name="body" type="textarea" label="Body" placeholder="The post's contents..." rows="25" class="mt-3" />
        
        <x-input.select name="tags" class="my-2" multiple>
            <option disabled>Tags:</option>
            @foreach (\App\Models\Tag::all()->pluck('name') as $tag)
                <option value="{{ $tag }}">{{ $tag }}</option>
            @endforeach
        </x-input.select>

        <hr class="text-dark-gamma" />

        <div class="flex flex-row gap-2 mt-2">
            <button
                type="submit"
                name="published" 
                value="0"
                class="bg-dark-beta hover:bg-accent border border-accent text-light cursor-pointer px-0.5"
            >
                Save
            </button>

            <button
                type="submit"
                name="published" 
                value="1"
                class="bg-dark-beta hover:bg-accent border border-accent text-light cursor-pointer px-0.5"
            >
                Save & Publish
            </button>
        </div>
    </form>
</x-layout>