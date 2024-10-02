<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Mary\Traits\Toast;

class EditPost extends Component
{
    use Toast;

    public $post;

    public $title;

    public $content;

    public function mount(Post $post): void
    {
        $this->post = $post;

        $this->fill(
            $post->only('id', 'title', 'content'),
        );
    }

    public function save(): void
    {
        $data = $this->validate();

        $this->post->update($data);

        // You can toast and redirect to any route
        $this->success('Post updated with success.', redirectTo: '/post');
    }

    public function render()
    {
        return view('livewire.edit-post');
    }
}
