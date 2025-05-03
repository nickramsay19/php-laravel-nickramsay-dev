@props(['comment', 'expanded'])

<article dir="ltr" class="ml-2 mt-2 border-l-2 border-accent pl-2">
    <div class="flex flex-row group justify-between">
        <x-link href="#" class="align-top basis-full grow font-semibold group-hover:underline">
            {{ $comment->author->name }}
        </x-link>

        <div class="flex flex-col sm:flex-row gap-2 text-right">
            <x-link hx-post="{{ route('posts.commands.publish', $comment->post->slug) }}" hx-swap="none" class="text-yellow-500 underline cursor-pointer hover:font-semibold">
                reply
            </x-link>
        </div>
    </div>

    <span>{{ $comment->body }}</span>

    @php
        $url = request()->fullUrlWithQuery([
            'expand' => collect(request()->input('expand', []))
                ->merge([$comment->id])
                ->unique()
                ->all()
        ]);
    @endphp

    @if ($comment->children->isNotEmpty() && !$expanded->contains($comment->id))
        <div class="mt-1">
            <a href="{{ $url }}" class="text-accent underline hover:font-semibold">Load replies</a>
        </div>
    @endif

    {{-- Recurse into children if expanded --}}
    @if ($expanded->contains($comment->id))
        @foreach ($comment->children as $child)
            <x-comment-thread :comment="$child" :expanded="$expanded" />
        @endforeach
    @endif
</article>
