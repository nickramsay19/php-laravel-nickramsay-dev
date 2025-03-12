<article dir="ltr" {{ $attributes->merge(['class' => 'flex flex-col justify-between gap-1 border-l-2 border-accent pl-1']) }}>
    <div class="flex flex-row">
        <x-link href="/posts/{{ $post->slug }}" class="align-top basis-full grow font-semibold">{{ $post->title }}</x-link>

        @if (isset($showCommands) && $showCommands == true)
            <x-posts.command-bar :post="$post" class="justify-end" />
        @endif

    </div>

    <span>
        <span>{{ $post->created_at_date }}</span>
        @foreach ($post->tags as $tag)
            <x-tag-link :tag="$tag" />
        @endforeach
    </span>
</article>