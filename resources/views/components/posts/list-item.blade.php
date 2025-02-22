<article dir="ltr" {{ $attributes->merge(['class' => 'flex flex-col justify-between gap-1 border-l-2 border-accent pl-1']) }}>
    <div class="flex flex-row">
        <x-link href="/posts/{{ $post->slug }}" class="align-top basis-full grow font-semibold">{{ $post->title }}</x-link>
        
        @if (Auth::check() && isset($showAdminOptions) && $showAdminOptions)
            <div class="flex gap-2 justify-end">
                <x-link hx-delete="{{ route('posts.destroy', $post->slug) }}" hx-swap="none" class="text-rose-500 underline">delete</x-link>
            
                @if ($post->published_at == null) 
                    <x-link hx-post="{{ route('posts.commands.publish', $post->slug) }}" hx-swap="none" class="text-yellow-500 underline">publish</x-link>
                @endif
            </div>
        @endif
    </div>

    <span>
        <span>{{ $post->created_at_date }}</span>
        @foreach ($post->tags as $tag)
            <x-tag-link :tag="$tag" />
        @endforeach
    </span>
</article>