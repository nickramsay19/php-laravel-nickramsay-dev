<x-layout title="Create">
    <x-form method="POST" :action="route('posts.store')">
        <x-form.input-group name="title" label="Title" style="width: 100%;" />

        <x-form.input-group name="body" type="textarea" label="Post body"  rows="5" style="width: 100%;" />

        @foreach (\App\Models\Tag::all()->pluck('name') as $tag)
            <x-form.input-group name="tags[]" type="checkbox" value="{{ $tag }}" label="{{ $tag }}"/>
        @endforeach


        <x-form.input-group name="published" type="checkbox" label="Publish"/>

        <x-form.input-group name="save" type="submit" value="save" />


    </x-form>
</x-layout>