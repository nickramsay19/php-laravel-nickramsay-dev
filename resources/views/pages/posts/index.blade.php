<x-layout title="Posts">
    @if (count($tags) > 0)
        <small style="margin: 0 1em 0 0;">
            filters:
            @foreach ($tags as $tag)
                {{ $tag }}&nbsp;
            @endforeach
            <x-link to="posts" style="text-decoration: underline; color: var(--color-danger); margin-left: 0.5em;">clear</x-link>
            <br />
        </small>
    @endif

    <x-posts.list :posts="$posts" :show-admin-options="true" />
</x-layout>