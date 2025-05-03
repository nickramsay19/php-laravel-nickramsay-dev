<x-layout title="{{ $post ? $post->title : '404 Post not found' }}">
    {{ $post }}
    
    
    @if ($post)
        <div class="flex flex-row mb-1">
            <div class="basis-full grow">
                <span>{{ $post->created_at_date }}</span>
                @foreach ($post->tags as $tag)
                    <x-tag-link :tag="$tag" />
                @endforeach
            </div>

            <x-posts.command-menu :post="$post" showIsListed="true" class="justify-end" />
        </div>

        <div class="post-body">{!! Illuminate\Mail\Markdown::parse($post->body) !!}</div>

        <hr class="text-dark-gamma mt-24" />

    
        <div class="my-5">
            <form hx-post="{{ route('comments.store') }}" hx-ext='json-enc-custom' class="flex flex-col">
                <input type="hidden" name="parent_post_id" value="{{ $post->id }}" />
                <x-input name="body" type="textarea" placeholder="The reply's contents..." rows="3" class="mt-3 [&_textarea]:!border-chicago-500"></x-input>
                <button
                    type="submit"
                    class="bg-dark-beta hover:bg-accent border border-chicago-500 text-light cursor-pointer px-0.5"
                >
                    Save
                </button>
            </form>
        </div>

        <div class="mt-2">
            @foreach ($post->comments as $comment)
                @if ($comment->parent_comment_id === null || $expanded->contains($comment->parent_comment_id))
                    {{ $comment }}

                    <x-comment :comment="$comment" />
                @endif
            @endforeach
        </div>
    @else
        There is no post by this name. Go <x-link to="home">home</x-link>?
    @endif
</x-layout>
