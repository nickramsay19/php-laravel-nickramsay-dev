{{-- resources/views/feeds/rss.blade.php --}}
{!! '<?xml version="1.0" encoding="utf-8"?>' !!}
<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/">
    <channel>
        <title>{{ config('app.name') }}</title>
        <link>{{ url('/posts') }}</link>
        <description>I'm an aspiring software engineer, interested in systems programming, server administration, programming language development and much more.</description>
        <lastBuildDate>{{ now()->toRfc2822String() }}</lastBuildDate>

        @foreach($posts as $post)
            <item>
                <title>{{ $post->title }}</title>
                <link>{{ route('posts.show', $post->slug) }}</link>
                <guid isPermaLink="true">{{ route('posts.show', $post->slug) }}</guid>
                <pubDate>{{ $post->created_at->toRfc2822String() }}</pubDate>
                <description><![CDATA[
                    {{ Str::limit(strip_tags($post->body), 200) }}
                ]]></description>
                <content:encoded><![CDATA[
                    {!! $post->body !!}
                ]]></content:encoded>
            </item>
        @endforeach
    </channel>
</rss>