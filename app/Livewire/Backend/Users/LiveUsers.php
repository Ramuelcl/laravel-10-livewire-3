<?php

namespace App\Livewire\Backend\Users;

use App\Models\User;
use Livewire\Component;

class LiveUsers extends Component
{

    protected $listeners = ['searchApplied', 'is_activeApplied', 'TabUserApplied'];
    public $tabs, $activeTab = 0;

    public function mount()
    {
        $this->tabs = config('app_settings.tabs-users');
        // dd($this->tabs);
    }

    public function render()
    {
        // return view('livewire.backend.users.live-users'); //, ['users' => $this->users]
        return view('livewire.backend.users.live-users', [
            'tabs' => $this->tabs,
            'activeTab' => $this->activeTab,
        ]);
    }

    public function TabUserApplied($index)
    {
        // dump(['LiveUsers' => $index]);
        $this->activeTab = $index;
    }
}
