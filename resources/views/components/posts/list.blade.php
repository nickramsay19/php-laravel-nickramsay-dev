<div class="flex flex-col gap-2">
    @if (Auth::check() && isset($showAdminOptions) && $showAdminOptions)
        <x-link to="posts.create">Create a new post</x-link>
    @endif

    @foreach ($posts as $post)
        <x-posts.list-item :post="$post" show-admin-options="{{ $showAdminOptions ?? false }}" />
        <hr class="text-dark-gamma last:hidden" />
    @endforeach
</div>