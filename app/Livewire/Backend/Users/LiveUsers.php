<?php

namespace App\Livewire\Backend\Users;

use App\Models\User;
use Livewire\Component;

class LiveUsers extends Component
{
    protected $listeners = ['searchApplied', 'is_activeApplied', 'TabUserApplied'];
    public $tabs,
        $activeTab = '#listado',
        $accion;

    public function mount()
    {
        $this->tabs = config('app_settings.tabs-users');
        // dd($this->tabs);
        // $this->activeTab = '#listado';
    }

    public function render()
    {
        return view('livewire.backend.users.live-users', [
            'tabs' => $this->tabs,
            'activeTab' => $this->activeTab,
        ]);
    }

    public function TabUserApplied($tab = '#listado', $accion)
    {
        // dump(['LiveUsers' => $tab, 'accion' => $accion]);
        $this->activeTab = $tab;
        $this->accion = $accion;
    }
}
