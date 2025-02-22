<x-layout title="{{ $post ? $post->title : '404 Post not found' }}">
    @if ($post)
        <span>
            <span>{{ $post->created_at_date }}</span>
            @foreach ($post->tags as $tag)
                <x-tag-link :tag="$tag" />
            @endforeach
        </span>

        <p style="margin-top: 1em;">{{ $post->body }}</p>


        <strong>dump</strong>
        <p>
            {{ $post }}
        </p>
    @else
        There is no post with by this name. Go <x-link to="home">home</x-link>?
    @endif
</x-layout>