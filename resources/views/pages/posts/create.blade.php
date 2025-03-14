<x-layout title="Create">
    <form hx-post="{{ route('posts.store') }}" hx-ext='json-enc-custom' class="flex flex-col">
        
        <x-input name="title" type="text" label="Title" placeholder="Your post's title" required/>

        <x-input name="body" type="textarea" label="Body" placeholder="The post's contents..." rows="25" class="mt-3"></x-form.input-group>
        
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
    <script>
        function handleMultipleOptionMouseDown(event) {
            this.selected = !this.selected;
            event.preventDefault();
        }
    </script>
</x-layout>