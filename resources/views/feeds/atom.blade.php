{{-- resources/views/feeds/atom.blade.php --}}
@php 
    echo '<?xml version="1.0" encoding="UTF-8" ?>';
@endphp
<feed xmlns="http://www.w3.org/2005/Atom">
    <title>{{ config('app.name') }}</title>
    <link href="{{ url('/posts') }}" rel="alternate" />
    <updated>{{ now()->toAtomString() }}</updated>
    <id>{{ url('/posts') }}</id>

    @foreach($posts as $post)
        <entry>
            <title>{{ $post->title }}</title>
            <link href="{{ route('posts.show', $post->slug) }}" />
            <id>{{ route('posts.show', $post->slug) }}</id>
            <updated>{{ $post->created_at->toAtomString() }}</updated>
            <summary type="html"><![CDATA[
                {{ Str::limit(strip_tags($post->body), 200) }}
            ]]></summary>
            <content type="html"><![CDATA[
                {!! $post->body !!}
            ]]></content>
        </entry>
    @endforeach
</feed>
