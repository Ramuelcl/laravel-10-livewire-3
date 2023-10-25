<?php

namespace App\Livewire\Post;

use App\Models\User;
use Livewire\Component;

class LivePost extends Component
{
    // array, string, integer, float, boolean, null
    // collections, models, datetime, etc

    public $titulo = 'Posts';
    // colección
    public $user;
    // campos
    public $name;
    public $email;
    //

    public function mount(User $user)
    {
        // $this->user = $user;
        // $this->email = $user->email;
        $this->fill(
            $user->only(
                [
                    'name',
                    'email'
                ]
            )
        );
    }

    public function render()
    {
        return view('livewire.post.live-post');
    }

    public function save()
    {
        // dump($this->name);
    }
}
