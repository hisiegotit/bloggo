@php
    $Parsedown = new Parsedown();
@endphp
<div class="container mx-auto p-4">
    <div class="rounded-lg p-6 px-64">
        <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>
        <p class="text-gray-600 mb-4">By me on {{ $post->created_at->format('F j, Y') }}</p>
        <div class="prose">
            {!! $Parsedown->text($post->content) !!}
        </div>
    </div>
</div>
