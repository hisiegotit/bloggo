<div class="container mx-auto p-4">
    <div class="rounded-lg p-6 px-64">
        @foreach($posts as $post)
            <a href="{{ route('post.show', ['post' => $post]) }}">

                <x-card title="{{ $post->title }}"  subtitle="{{ $post->created_at }}" separator class="mt-2">
                    {{ $post->content }}
                </x-card>
            </a>
        @endforeach
    </div>
</div>
