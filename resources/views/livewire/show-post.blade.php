@php
    $Parsedown = new Parsedown();
    $content = $Parsedown->text($post->content);
    $content = preg_replace('/<img/', '<img class="center-image"', $content);
@endphp
<div class="container dark:text-white text-black mx-auto p-4">
    <div class="rounded-lg p-6 px-48">
        <h1 class="text-5xl font-bold mb-4">{{ $post->title }}</h1>
        <p class="text-pink-500 dark:text-blue-500 mb-4">By me on {{ $post->created_at->format('F j, Y') }}</p>
        <div class="text-justify">
            {!! $content !!}
        </div>
    </div>
</div>
