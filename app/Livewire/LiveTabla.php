<?php

namespace App\Livewire;

use Livewire\Component;

class LiveTabla extends Component
{
    public $data;
    public $td;



    public function mount($data, $td)
    {
        $this->data = $data;
        $this->td = $td;
    }

    public function render()
    {
        return view('livewire.live-tabla');
    }

    public function alternarVentana($opcion = 0)
    {
        // dd('alternarVentana');

    }
}
