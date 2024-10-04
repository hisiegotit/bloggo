<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

class ArchivePost extends Component
{
    use Toast, WithPagination;

    public string $search = '';

    public bool $drawer = false;

    public array $sortBy = ['column' => 'id', 'direction' => 'asc'];

    public function headers(): array
    {
        return [
            ['key' => 'id', 'label' => '#', 'class' => 'w-1'],
            ['key' => 'title', 'label' => 'Title', 'class' => 'w-64'],
        ];
    }

    public function restore($postId)
    {
        $post = Post::withTrashed()->findOrFail($postId);
        $post->restore();
        $this->success("Post #$post->id restored", 'Thanks!', position: 'toast-bottom');
    }

    public function posts(): LengthAwarePaginator
    {
        return Post::query()
        ->onlyTrashed()
        ->when($this->search, fn(Builder $q) => $q->where('title', 'like', "%$this->search%"))
        ->paginate(10);
    }

    public function render()
    {
        return view('livewire.archive-post', [
            'posts' => $this->posts(),
            'headers' => $this->headers()
        ]);
    }
}
