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

        <hr class="text-dark-gamma last:hidden my-6" />

        @if (Auth::check())
            <h3 class="text-lg font-semibold">Post a comment</h3>
            <form hx-post="{{ route('comments.store') }}" hx-ext='json-enc-custom' class="flex flex-col mb-4">
                
                <input type="hidden" name="post_id" value="{{ $post->id }}" />
                <input type="hidden" name="reference_id" :value="null" />
                <x-input name="body" type="textarea" placeholder="The comment's content" rows="3" class="mt-1" />
                <div class="flex flex-row gap-2 mt-2">
                    <button
                        type="submit"
                        class="bg-dark-beta hover:bg-accent border border-accent text-light cursor-pointer px-0.5"
                    >
                        Save
                    </button>
                </div>
            </form>
        @endif

        <div>
            @if ($post->comments->count() > 0)
                <h3 class="text-lg font-semibold">Comments</h3>
            @endif

            @foreach ($post->comments as $comment)
                <x-comment :comment="$comment" />
            @endforeach
        </div>

        <script>
            var ids = [];

            function toggleReplyForm(id) {
                if (ids.indexOf(id) == -1) {
                    ids.push(id);
                }

                ids.forEach(function (otherId) {
                    var replyForm = document.getElementById("reply-form-" + otherId);
                    var visible = replyForm.style.display != "none";

                    if (otherId != id) {
                        replyForm.style.display = "none";
                    } else {
                        replyForm.style.display = visible ? "none" : "block";  
                    }
                });
            }
        </script>
    @else
        There is no post with by this name. Go <x-link to="home">home</x-link>?
    @endif
</x-layout>
