<?php

namespace App\Livewire\Backend;

use Livewire\Component;

class LivePaises extends Component
{
    public $paises = ['Peru', 'Colombia', 'Chile', 'Argentina'];
    public $pais;

    public $is_active;

    public $showList = true;
    public $showForm = 1;

    public function render()
    {
        return view('livewire.backend.live-paises');
    }

    public function fncSave()
    {
        array_push($this->paises, $this->pais);
        $this->reset(['pais']);
    }

    public function fncDelete($key)
    {
        unset($this->paises[$key]);
    }

    public function changeIs_Active($pais)
    {
        $this->is_active = $pais;
    }
}
