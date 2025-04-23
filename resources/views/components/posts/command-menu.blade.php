@canany(['update', 'delete'], $post)
    <div {{ $attributes->merge(['class' => 'flex flex-col sm:flex-row gap-2 text-right']) }}>
        @can ('update', $post)
            @if ($post->published_at === null) 
                <x-link hx-post="{{ route('posts.commands.publish', $post->slug) }}" hx-swap="none" class="text-yellow-500 underline cursor-pointer hover:font-semibold">publish</x-link>
            @else
                <x-link hx-post="{{ route('posts.commands.unpublish', $post->slug) }}" hx-swap="none" class="text-yellow-500 underline cursor-pointer hover:font-semibold">unpublish</x-link>
            @endif

            <x-link href="{{ route('posts.edit', $post->slug) }}" class="text-accent underline hover:font-semibold">edit</x-link>
        @endcan

        @can ('delete', $post)
            <x-link hx-delete="{{ route('posts.destroy', $post->slug) }}" class="text-rose-500 underline cursor-pointer hover:font-semibold">delete</x-link>
        @endif
    </div>
@endcan
