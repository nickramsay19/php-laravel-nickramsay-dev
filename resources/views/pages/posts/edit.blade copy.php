<x-layout title="Edit">
    <form hx-post="{{ route('posts.store') }}" class="flex flex-col">
        
        <x-form.input-group name="title" type="text" label="Title" placeholder="Your post's title" required/>

        <x-form.input-group name="body" type="textarea" label="Body" placeholder="The post's contents..." class="mt-3" />
        
        <div class="flex flex-row gap-2 mt-3">
            <script>
                function handleMultipleOptionMouseDown(event) {
                    this.selected = !this.selected;
                    event.preventDefault();
                }
            </script>

            <span>Tags:</span>

            <select multiple class="flex-row [&_option]:inline [&_option]:not-last:mr-2">
                @foreach (\App\Models\Tag::all()->pluck('name') as $tag)
                    <option name="tags[]" value="{{ $tag }}" onmousedown="handleMultipleOptionMouseDown" class="italic bg-transparent checked:text-accent checked:font-semibold">{{ $tag }}</option>
                @endforeach
            </select>
        </div> 

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
</x-layout>