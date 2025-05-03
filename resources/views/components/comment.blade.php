@props([
    'comment' => null,
])

<article class="flex flex-col gap-1 border-l-2 border-accent pl-1">

    <div class="flex justify-between">
        <span class="flex gap-2">
            <x-link href="#" class="font-semibold">{{ $comment->author->name }}</x-link>
            <span class="text-disabled">{{ $comment->created_at_date }}</span>
        </span>

        <div class="text-right">
            <x-link 
                class="text-yellow-500 underline cursor-pointer hover:font-semibold"
                onclick="this.closest('article').querySelector('.reply-form').classList.remove('hidden')"
            >
                Reply
            </x-link>
        </div>
    </div>

    <span>
        {{ $comment->body }}
    </span>

    <div class="reply-form hidden my-5">
        <form hx-post="{{ route('comments.store') }}" hx-ext='json-enc-custom' class="flex flex-col">
            <input type="hidden" name="parent_post_id" value="{{ $comment->id }}" />
            
            <x-input name="body" type="textarea" placeholder="The reply's contents..." rows="3" class="mt-3" />

            <div class="flex justify-between items-center mt-2">
                <button
                    type="submit"
                    class="bg-dark-beta hover:bg-accent border border-chicago-500 text-light cursor-pointer px-0.5"
                >
                    Save
                </button>

                <button
                    type="button"
                    onclick="this.closest('.reply-form').classList.add('hidden')"
                    class="text-red-500 underline ml-2"
                >
                    Cancel
                </button>
            </div>
        </form>
    </div>

    @if ($comment->comments->count() > 0)
        <div class="ml-2 mt-2">
            @foreach ($comment->comments as $subComment)
                <x-comment :comment="$subComment" />
            @endforeach 
        </div>
    @endif

</article>
