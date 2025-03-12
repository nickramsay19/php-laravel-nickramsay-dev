<x-layout title="Create">
    <form hx-post="{{ route('posts.store') }}" class="flex flex-col">
        <input name="title" type="text" required />
        <textarea name="body"></textarea>

        <script>

            function handleMultipleOptionMouseDown(event) {
                console.log('clicked!');//, this, this.selected);
                this.selected = !this.selected;
                event.preventDefault();
            }
        </script>

        <select multiple class="flex-row [&_option]:inline [&_option]:not-last:mr-2">
            @foreach (\App\Models\Tag::all()->pluck('name') as $tag)
                <option name="tags[]" value="{{ $tag }}" onmousedown="handleMultipleOptionMouseDown" class="italic bg-transparent checked:text-accent checked:font-semibold">{{ $tag }}</option>
            @endforeach
        </select>

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
    </form>
</x-layout>