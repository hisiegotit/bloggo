<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;

class Welcome extends Component
{
    public $post;
    public $title;
    public function posts()
    {
        return Post::orderBy('id', 'desc')->get();
    }

    public function render()
    {
        $posts = Post::all();
        return view('livewire.welcome', [
            'posts' => $posts
        ]);
    }
}
