<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Livewire\Component;
use Mary\Traits\Toast;
use Livewire\WithPagination;
class ListPost extends Component
{
    use Toast, WithPagination;

    public string $search = '';

    public bool $drawer = false;

    public array $sortBy = ['column' => 'id', 'direction' => 'asc'];

    // Clear filters
    public function clear(): void
    {
        $this->reset();
        $this->success('Filters cleared.', position: 'toast-bottom');
    }

    // Delete action
    public function delete(Post $post): void
    {
        $post->delete();
        $this->success("Post #$post->id deleted", 'Thanks!', position: 'toast-bottom');
    }

    // Table headers
    public function headers(): array
    {
        return [
            ['key' => 'id', 'label' => '#', 'class' => 'w-1'],
            ['key' => 'title', 'label' => 'Title', 'class' => 'w-64'],
        ];
    }

    /**
     * For demo purpose, this is a static collection.
     *
     * On real projects you do it with Eloquent collections.
     * Please, refer to maryUI docs to see the eloquent examples.
     */
    public function posts(): LengthAwarePaginator
    {
        return Post::query()
        ->when($this->search, fn(Builder $q) => $q->where('title', 'like', "%$this->search%"))
        ->paginate(10);
    }

    public function render()
    {
        return view('livewire.list-post', [
            'posts' => $this->posts(),
            'headers' => $this->headers()
        ]);
    }
}
