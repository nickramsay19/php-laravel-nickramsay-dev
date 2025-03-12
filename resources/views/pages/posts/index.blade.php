<x-layout title="Posts">
    <div x-data="searchComponent()">
        <div class="flex flex-row gap-1 text-center mt-2">
            <x-form.input-group 
                type="text" 
                x-model="query"
                x-on:input.debounce.300ms="updateSearch()"
                placeholder="search..." 
                class="flex-grow"
            />
            <x-button class="text-center">v</x-button>
        </div>

        <x-posts.list id="posts-list" :posts="$posts" :show-commands="true" class="flex-none" />
    </div>

    <script>
        function searchComponent() {
            return {
                query: new URLSearchParams(window.location.search).get('search') || '',
                updateSearch() {
                    const url = new URL(window.location);
                    if (this.query) {
                        url.searchParams.set('search', this.query);
                    } else {
                        url.searchParams.delete('search');
                    }
                    window.history.pushState({}, '', url);

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
                }
            };
        }
    </script>
</x-layout>