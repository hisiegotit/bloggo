<?php
namespace App\Support;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Markdown;

class Spotlight
{
    public function search(Request $request)
    {
        return Post::query()
            ->where('title', 'like', "%$request->search%")
            ->take(5)
            ->get()
            ->map(function (Post $post) {
                return [
                    'id' => $post->id,
                    'name' => $post->title,
                    'description' => $post->content,
                    'link' => "/post/edit/{$post->id}"
                ];
            });
    }
}
