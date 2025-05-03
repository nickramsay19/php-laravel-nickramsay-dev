<x-layout title="{{ $post ? $post->title : '404 Post not found' }}">
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

        <div class="mt-2">
            @foreach ($post->comments as $comment) 
                <article dir="ltr" class="flex flex-col justify-between gap-1 border-l-2 border-accent pl-1">
                    <div class="flex flex-row group justify-between">
                        <x-link href="#" class="align-top basis-full grow font-semibold group-hover:underline">{{ $comment->author->name }}</x-link>

                        <div class="flex flex-col sm:flex-row gap-2 text-right">
                            <x-link hx-post="{{ route('posts.commands.publish', $post->slug) }}" hx-swap="none" class="text-yellow-500 underline cursor-pointer hover:font-semibold">reply</x-link>
                        </div>
                    </div>

                    <span>
                        {{ $comment->body }}
                    </span>

                    

                </article>
            @endforeach
        </div>

        <div class="my-5">
            <form hx-post="{{ route('posts.store') }}" hx-ext='json-enc-custom' class="flex flex-col">
                <input type="hidden" name="parent_post_id" value="{{ $post->id }}" />

                <x-input name="body" type="textarea" placeholder="The reply's contents..." rows="3" class="mt-3 [&_textarea]:!border-chicago-500"></x-input>
    
                <hr class="text-dark-gamma" />

                <button
                    type="submit"
                    class="bg-dark-beta hover:bg-accent border border-chicago-500 text-light cursor-pointer px-0.5"
                >
                    Save
                </button>
            </form>
        <div>

    @else
        There is no post with by this name. Go <x-link to="home">home</x-link>?
    @endif
</x-layout>
