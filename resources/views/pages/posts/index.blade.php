<x-layout title="Posts">
    <div 
        x-data="{
            params: new URLSearchParams(window.location.search),
            fetch() {
                const url = new URL(window.location);

                // fetch the full page but replace only the #posts-list div
                fetch(url.href, {
                    headers: { 'HX-Request': 'true' } // simulate HTMX-like header
                })
                .then(response => response.text())
                .then(html => {
                    let parser = new DOMParser();
                    let doc = parser.parseFromString(html, 'text/html');
                    let newContent = doc.querySelector('#posts-list');
                    document.querySelector('#posts-list').replaceWith(newContent);
                })
                .catch(error => console.error('Error fetching search results:', error));
            },
            setParam(param, value) {
                const url = new URL(window.location);
                if (value == null || value === '' || (Array.isArray(value) && value.length === 0)) {
                    url.searchParams.delete(param);
                } else {
                    url.searchParams.set(param, value);
                }
                window.history.pushState({}, '', url);
                this.fetch();
            },
            getTags() {
                return this.params.get('tags')?.split(',').map(item => item.trim()) ?? [];
            },
        }"
    >
        <x-input 
            type="text" 
            x-bind:value="params.get('search')"
            x-on:input.debounce.300ms="setParam('search', $event.target.value)"
            placeholder="search..." 
            class="mt-2"
        />

        <div class="flex flex-col md:flex-row gap-1 justify-left md:justify-between w-full mt-2 pb-1">
            <x-input.select 
                name="tags"
                
                ::value="getTags()"
                x-on:input.debounce.300ms="setParam('tags', $event.target.value)"
                class="w-full"
                multiple
            >
                <option disabled>tags:</option>
                @foreach (\App\Models\Tag::all()->pluck('name') as $tag)
                    <option value="{{ $tag }}" class="hover:underline">{{ $tag }}</option>
                @endforeach
            </x-input.select>

            <x-input
                type="date"
                name="created_after" 
                label="after: "
                x-bind:value="params.get('created_after')"
                x-on:input.debounce.300ms="setParam('created_after', $event.target.value)"
                class="flex-none w-full sm:w-auto"
                inline
            />
        </div>

        <hr class="text-dark-gamma last:hidden" />
        
        <x-posts.list id="posts-list" :posts="$posts" class="flex-none mt-2" />

        <x-pagination :page="$page" :perPage="$perPage" :totalPages="$totalPages" class="mb-2 mt-4 pt-4 pb-2" />
    </div>
</x-layout>