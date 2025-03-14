<x-layout title="Nicholas Ramsay">
    <p>I'm an aspiring software engineer, interested in systems programming, server administration, programming language development and much more.</p>
    <p class="my-2">I will be completing my Bachelor of Software Engineering at the University of New South Wales in 2024.</p>

    <section class="mt-2">
        <x-link to="posts" class="text-lg font-mono underline">Posts</x-link>
        <x-posts.list :posts="$posts" :show-admin-options="false" />
    </section>
</x-layout>