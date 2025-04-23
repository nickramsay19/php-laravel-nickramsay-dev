<item>
    <title>{{ $title }}</title>
    <link>{{ $link }}</link>
    <guid isPermaLink="true">{{ route('posts.show', $post->slug) }}</guid>
    <pubDate>{{ $post->created_at->toRfc2822String() }}</pubDate>
    <description><![CDATA[
        {{ Str::limit(strip_tags($post->body), 200) }}
    ]]></description>
    <content:encoded><![CDATA[
        {!! $post->body !!}
    ]]></content:encoded>
</item>
