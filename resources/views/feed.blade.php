<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0">
    <channel>
        <title>Suicide Squad 11.5 Blog</title>
        <link>{{ url('/') }}</link>
        <description>Latest articles from Suicide Squad 11.5 supporter community.</description>
        <language>en</language>
        @foreach($blogs as $blog)
            <item>
                <title>{{ $blog->title }}</title>
                <link>{{ route('blog.show', $blog->slug) }}</link>
                <guid>{{ route('blog.show', $blog->slug) }}</guid>
                <description><![CDATA[{!! $blog->excerpt !!}]]></description>
                <pubDate>{{ ($blog->published_at ?? $blog->created_at)->toRfc2822String() }}</pubDate>
            </item>
        @endforeach
    </channel>
</rss>
