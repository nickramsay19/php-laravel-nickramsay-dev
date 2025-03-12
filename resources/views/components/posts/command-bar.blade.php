@if (Auth::check())
    <div {{ $attributes->merge(['class' => 'flex gap-2']) }}>
        @can('update', $post)
            @if ($post->published_at === null) 
                <x-link hx-post="{{ route('posts.commands.publish', $post->slug) }}" hx-swap="none" class="text-yellow-500 underline">publish</x-link>
            @else (Auth::user()->can('unpublish', $post))
                <x-link hx-post="{{ route('posts.commands.unpublish', $post->slug) }}" hx-swap="none" class="text-yellow-500 underline">unpublish</x-link>
            @endif

            <x-link href="{{ route('posts.edit', $post->slug) }}" class="text-accent underline">edit</x-link>
        @endcan

        @if (Auth::user()->can('delete', $post))
            <x-link hx-delete="{{ route('posts.destroy', $post->slug) }}" hx-swap="none" class="text-rose-500 underline">delete</x-link>
        @endif
    </div>
@endif