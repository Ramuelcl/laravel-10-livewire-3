<?php

namespace App\Livewire;

use Livewire\Component;

class LiveSearch extends Component
{
    public $search = '';

    public function render()
    {
        return view('livewire.live-search');
    }

    public function updatedSearch()
    {
        $this->dispatch('searchApplied', $this->search);
    }
}
