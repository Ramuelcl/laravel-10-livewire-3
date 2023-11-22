<?php

namespace App\Livewire;

use Livewire\Component;

class LiveActive extends Component
{
    public $is_active = false;
    public function render()
    {
        return view('livewire.live-active');
    }

    public function updatedIs_Active()
    {
        $this->dispatch('is_activeApplied', $this->is_active);
    }
}
