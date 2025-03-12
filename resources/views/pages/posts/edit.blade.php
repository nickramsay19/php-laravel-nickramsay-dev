<x-layout title="Edit">
    <form hx-put="{{ route('posts.update', ['post' => $post->slug]) }}" hx-ext='json-enc-custom' class="flex flex-col">
        
        <x-form.input-group name="title" type="text" label="Title" placeholder="Your post's title" :value="$post->title" required/>

        <x-form.input-group name="body" type="textarea" label="Body" placeholder="The post's contents..." rows="25" class="mt-3">
            {{ $post->body }}
        </x-form.input-group>
        
        <select x-ref="tag-select" name="tags" multiple class="flex-row mt-3 [&_option]:inline [&_option]:not-last:mr-2">
            <option disabled class="text-rose-50">Tags:</option>
            @foreach (\App\Models\Tag::all()->pluck('name') as $tag)
                <option value="{{ $tag }}" onmousedown="handleMultipleOptionMouseDown" class="italic bg-transparent checked:text-accent checked:font-semibold">{{ $tag }}</option>
            @endforeach
        </select>

        <div class="flex flex-row gap-2 mt-3">
            <button
                type="submit"
                name="published" 
                value="0"
                class="bg-dark-beta hover:bg-accent border border-accent text-light cursor-pointer px-0.5"
            >
                Save
            </button>

            @if (!$post->is_published)
                <button
                    type="submit"
                    name="published" 
                    value="1"
                    class="bg-dark-beta hover:bg-accent border border-accent text-light cursor-pointer px-0.5"
                >
                    Save & Publish
                </button>
            @endif
        </div>
    </form>
    <script>
        function handleMultipleOptionMouseDown(event) {
            this.selected = !this.selected;
            event.preventDefault();
        }
    </script>
</x-layout>