<x-layout title="Edit">
    <form hx-put="{{ route('posts.update', ['post' => $post->slug]) }}" hx-ext='json-enc-custom' class="flex flex-col">
        
        <x-input name="title" type="text" label="Title" placeholder="Your post's title" :value="$post->title" required />

        <x-input name="body" type="textarea" label="Body" placeholder="The post's contents..." rows="25" class="mt-3">
            {{ $post->body }}
        </x-input>
        
        <x-input.select name="tags" value="{{ $post->tags->pluck('name')->toJson() }}" class="my-2" multiple>
            <option disabled>Tags:</option>
            @foreach (\App\Models\Tag::all()->pluck('name') as $tag)
                <option value="{{ $tag }}">{{ $tag }}</option>
            @endforeach
        </x-input.select>

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