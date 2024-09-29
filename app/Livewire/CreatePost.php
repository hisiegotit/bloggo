<?php

namespace App\Livewire;

use Livewire\Component;

class CreatePost extends Component
{
    public $title = "Vợ Trinh tuyệt vời nhất";
    public $content;

    public function render()
    {
        return view('livewire.create-post');
    }
}
