<div class="container mx-auto px-64">
    <ul class="space-y-4">
        @foreach ($posts as $post)
        <li>
            <div class="card-body">
                <a href="{{ route('post.show', ['post' => $post]) }}" class="text-3xl dark:text-white dark:hover:text-blue-300 dark:hover:duration-200 text-black font-semibold hover:text-pink-300 hover:duration-200">{{ $post->title }}</a>
                <p class="text-sm text-pink-500 dark:text-blue-400">{{ $post->created_at->format('F j, Y') }}</p>
            </div>
        </li>
        @endforeach
    </ul>
</div>
