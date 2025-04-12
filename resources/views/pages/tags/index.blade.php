<x-layout title="Tags">
    <div>
        @can ('create', App\Models\Tag::class)
            <div class="mb-2">
                <x-link to="tags.create">Create a new tag</x-link>
            </div>
        @endcan

        <div class="flex flex-col gap-1 w-full">
            @foreach ($tags as $tag)
                <div class="flex flex-row group">
                    <span class="group-hover:font-semibold">{{ $tag->name }}</span>
                    @canany (['update', 'delete'], $tag)
                        <span class="flex flex-row gap-2 ml-auto">

                            @can ('update', $tag)
                                <x-link href="{{ route('tags.edit', $tag->name) }}" class="text-accent underline hover:font-semibold">edit</x-link>
                            @endcan

                            @can ('delete', $tag)
                                <x-link hx-delete="{{ route('tags.destroy', $tag->name) }}" class="text-rose-500 underline cursor-pointer hover:font-semibold">delete</x-link>
                            @endcan
                        </span>
                    @endcanany
                </div>
                <hr class="text-dark-gamma last:hidden" />
            @endforeach 
        </div>
    </div>
</x-layout>