<x-layout title="Posts">
    <div 
        x-data="{
            params: new URLSearchParams(window.location.search),
            partialFetch() {
                const url = new URL(window.location);

                // fetch the full page but replace only the #posts-list div
                fetch(url.href, {
                    headers: { 'HX-Request': 'true' } // simulate HTMX-like header
                })
                .then(response => {
                    const html = response.text();

                    let parser = new DOMParser();
                    let doc = parser.parseFromString(html, 'text/html');
                    let newContent = doc.querySelector('#posts-list');
                    document.querySelector('#posts-list').replaceWith(newContent);
                })
                .catch(error => console.error('Error fetching search results:', error));
            },
            setParam(param, value) {
                const url = new URL(window.location);
                if (value == null || value === '' || (Array.isArray(value) && value.length === 0) || (param === 'page' && value === 1)) {
                    url.searchParams.delete(param);
                } else {
                    url.searchParams.set(param, value);
                }
                window.history.pushState({}, '', url);
            },
            setParamReload(param, value) {
                this.setParam(param, value);

                if (true || param == 'page' || this.params.get('page') > 1) {
                    location.reload();
                } else {
                    this.partialFetch();
                }
            },
            getTags() {
                return this.params.get('tags')?.split(',').map(item => item.trim()) ?? [];
            },
        }"
        x-init="setParam('page', {{ $page }})"
    >
        <x-input 
            type="text" 
            x-bind:value="params.get('search')"
            x-on:input.debounce.300ms="setParamReload('search', $event.target.value)"
            placeholder="search..." 
            class="mt-2"
        />

        <div class="flex flex-col md:flex-row gap-1 justify-left md:justify-between w-full mt-2 pb-1">
            <x-input.select 
                name="tags"
                
                ::value="getTags()"
                x-on:input.debounce.300ms="setParamReload('tags', $event.target.value)"
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
                x-on:input.debounce.300ms="setParamReload('created_after', $event.target.value)"
                class="flex-none w-full sm:w-auto"
                inline
            />
        </div>

        <hr class="text-dark-gamma last:hidden" />
        
        <div id="posts-list" class="mt-2">
            <x-posts.list :posts="$posts" class="flex-none" />

            @if ($totalPages < 1)
                <p class="mt-2">
                    No posts match your filters. Go <a href="/posts" class="text-accent underline">back</a>?
                </p>
            @endif

            @if ($totalPages > 1)
                <div class="flex flex-row justify-between mb-2 mt-4 pt-4 pb-2">
                    <div>
                        <span>{{ $page }} / {{ $totalPages }}</span>
                    </div>

                    <div class="flex flex-row gap-2">
                        <button
                            name="page"
                            value="{{ $page - 1 }}"
                            x-on:click="setParamReload('page', $event.target.value)"
                            class="appearance-none !bg-transparent !text-accent disabled:!text-disabled underline !border-0 cursor-pointer disabled:!cursor-default"
                            :disabled="{{ $page <= 1 ? 'true' : 'false' }}"
                        >
                            prev
                        </button>
                        <button
                            name="page"
                            value="{{ $page + 1 }}"
                            x-on:click="setParamReload('page', $event.target.value)"
                            class="appearance-none !bg-transparent !text-accent disabled:!text-disabled underline !border-0 cursor-pointer disabled:!cursor-default"
                            :disabled="{{ $page >= $totalPages ? 'true' : 'false' }}"
                        >
                            next
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layout>