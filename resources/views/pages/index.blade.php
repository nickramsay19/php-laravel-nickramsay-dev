<x-layout title="index">
    <section class="mt-2">
        
        <x-posts.list :posts="$posts" readonly />

        <hr class="text-dark-gamma mt-4 mb-2" />
        
        <x-link to="posts" class="font-mono font-sembold underline">see all posts</x-link>
    </section>
</x-layout>