@props([
    'post' => null,
    'readonly' => false,
])

@php
    $readonly = boolval($readonly);
@endphp

<article dir="ltr" {{ $attributes->merge(['class' => 'flex flex-col justify-between gap-1 border-l-2 border-accent pl-1']) }}>
    <div class="flex flex-row group">
        <x-link href="/posts/{{ $post->slug }}" class="align-top basis-full grow font-semibold group-hover:underline">{{ $post->title }}</x-link>

        @if ($readonly === false)
            <x-posts.command-menu :post="$post" class="justify-end" />
        @endif
    </div>

    <span>
        <span>{{ $post->created_at_date }}</span>
        @foreach ($post->tags as $tag)
            <x-tag-link :tag="$tag" />
        @endforeach
    </span>
</article>