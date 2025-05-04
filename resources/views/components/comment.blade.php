<div class="flex flex-col gap-2">
    <div class="flex flex-col justify-between gap-1 border-l-2 border-accent pl-2 my-1 mt-2">

        <div class="flex flex-row group gap-1 justify-between">

            <div class="flex flex-row group gap-2 justify-left">
                <x-link href="#" class="align-top basis-full grow font-semibold group-hover:underline">{{ $comment->author->name }}</x-link>
                <span class="text-disabled">{{ $comment->created_at_date }}
            </div>

            @if (Auth::check())
                <a href="#" onclick="toggleReplyForm({{ $comment->id }})" class="text-yellow-500 underline cursor-pointer hover:font-semibold">reply</a>
            @endif
        </div>

        <span>
            {{ $comment->body }}
        </span>

        @if (Auth::check())
            <div id="reply-form-{{ $comment->id }}" style="display: none" class="flex flex-col justify-between gap-1 border-l-2 border-accent pl-2 my-1 mt-2">
                <div class="flex flex-row gap-1">
                    <x-link href="#" class="align-top basis-full grow font-semibold group-hover:underline">{{ Auth::user()->name }}</x-link>
                </div>

                <form hx-post="{{ route('comments.store') }}" hx-ext='json-enc-custom' class="flex flex-col">

                    <input type="hidden" name="post_id" value="{{ $comment->post_id }}" />
                    <input type="hidden" name="reference_id" value="{{ $comment->id }}" />
                    <x-input name="body" type="textarea" placeholder="The reply's content" rows="3" class="mt-1" />
                    <div class="flex flex-row gap-2 mt-2">
                        <button
                            type="button"
                            onclick="toggleReplyForm({{ $comment->id }})" 
                            class="bg-dark-beta hover:!bg-red-500 border !border-red-500 text-light cursor-pointer px-0.5"
                        >
                            Cancel
                        </button>
                        <button
                            type="submit"
                            class="bg-dark-beta hover:bg-accent border border-accent text-light cursor-pointer px-0.5"
                        >
                            Save
                        </button>
                    </div>
                </form>
            </div>
        @endif

        @foreach ($comment->referrers as $refferer)
            <x-comment :comment="$refferer" />
        @endforeach
    </div>
</div>
