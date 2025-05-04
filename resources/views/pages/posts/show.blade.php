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

        <div class="mt-5">
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
