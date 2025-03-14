@props([
    'posts' => [],
    'readonly' => false,
])

@php
    if (isset($readonly) && $readonly !== false) {
        $readonly = true;
    }
@endphp

<div {{ $attributes->merge(['class' => 'flex flex-col gap-2']) }}>
    @if (Auth::permissions()->contains('create_posts') && !$readonly)
        <x-link to="posts.create">Create a new post</x-link>
    @endif

    @foreach ($posts as $post)
        <x-posts.list.item :post="$post" readonly="{{ $readonly }}" />

        <hr class="text-dark-gamma last:hidden" />
    @endforeach
</div>