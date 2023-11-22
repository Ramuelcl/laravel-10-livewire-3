<?php

namespace App\Livewire;

use Livewire\Component;

class LiveTabs extends Component
{
    public $tabs;
    public $activeTab = 0;

    public function mount($tabs, $activeTab)
    {
        $this->tabs = $tabs;
        $this->activeTab = $activeTab;
    }

    public function render()
    {
        return view('livewire.live-tabs');
    }

    public function setActiveTab($index)
    {
        // dump(['LiveTabs' => $index]);
        $this->activeTab = $index;
        $this->dispatch('TabUserApplied', $this->activeTab);
    }
}
