<x-layout title="{{ $post ? $post->title : '404 Post not found' }}">
    @if ($post)
        <div class="flex flex-row mb-1">
            <div class="basis-full grow">
                <span>{{ $post->created_at_date }}</span>
                @foreach ($post->tags as $tag)
                    <x-tag-link :tag="$tag" />
                @endforeach
            </div>

            <x-posts.command-menu :post="$post" class="justify-end" />
        </div>

        <div class="post-body">{!! Illuminate\Mail\Markdown::parse($post->body) !!}</div>
    @else
        There is no post with by this name. Go <x-link to="home">home</x-link>?
    @endif
</x-layout>
