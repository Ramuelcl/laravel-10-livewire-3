<?php

namespace App\Livewire\Backend\Users;

use App\Models\User;
//
use Exception;
// use Livewire\Attributes\Computed;
// use Livewire\Attributes\On;
use Livewire\Attributes\{On, Computed};
use Livewire\Component;
use Livewire\WithPagination;

class LiveList extends Component
{
    use WithPagination;

    public $onSearch, $search = '', $onActive, $chkActivos, $onAgregar;
    public $onPag, $xPags = [5, 10, 25, 50], $xPag = 5;
    public $sortField = 'id', $sortDir = 'desc';
    public $tabs, $tab = 0;
    // public $users;

    public function mount($onSearch = true, $onActive = true, $onPag = true, $onAgregar = true)
    {
        $this->onSearch = $onSearch;
        $this->onActive = $onActive;
        $this->onPag = $onPag;
        $this->onAgregar = $onAgregar;
    }

    #[On('agregarApplied')]
    public function btnAgregar($tab)
    {
        // dd($tab);
        $this->tab = $tab;
    }

    #[On('searchApplied')]
    public function search($search)
    {
        // dd($search);
        $this->search = $search;
    }

    #[Computed()]
    public function users()
    {
        $search = '%' . $this->search . '%';
        $this->resetPage();
        $users = User::where('id', 'like', $search)
            ->orWhere('name', 'like', $search)
            ->orWhere('email', 'like', $search)
            ->orderBy($this->sortField, $this->sortDir)
            ->when(
                $this->chkActivos,
                function ($query) {
                    return $query->Is_active();
                }
            )
            ->paginate($this->xPag);

        // $users = User::where('id', '>', '0')
        // ->when($this->search, function ($query) {
        //     return $query->where(function ($query) {
        //         $search = '%' . $this->search . '%';
        //         $query->where('id', 'like', $search)
        //             ->orWhere('name', 'like', $search)
        //             ->orWhere('email', 'like', $search);
        //     });
        // })
        // ->when($this->chkActivos, function ($query) {
        //     return $query->Is_active();
        // })
        // ->orderBy($this->sortField, $this->sortDir)
        // // ->get();
        // ->paginate($this->xPag)
        // ->toBase(); // Convierte a una colección Eloquent;
        // dd($users);
        return $users;
    }

    // public function render()
    // {
    //     // $this->users = User::latest()->get();
    //     //
    //     // sleep(3);

    //     return view('livewire.backend.users.live-list', [
    //         'users' => $this->users,
    //     ]);
    // }

    // public function totalUsuarios()
    // {
    //     return User::count();
    // }

    public function searchApplied($search)
    {
        dd($search);
    }

    public function fncOpciones($opcion, $row)
    {
        //
    }


    public function getAccess(User $user)
    {
        return true;
    }

    // evalua el ingreso y se ejecuta antes de enviar a guardar
    public function updating($property, $value)
    {
        if ($property == 'name') {
            if (empty($value)) {
                throw new Exception("Error Processing Request", 1);
            }
        }
    }
    // evalua el ingreso y se ejecuta despues de enviar a guardar
    public function updated($property, $value)
    {
        if ($property == 'name') {
            return strtoupper($value);
        }
    }

    public function TabForm($accion = '1')
    {
        $tab = '#usuarios';

        $this->dispatch('TabUserApplied', $tab, $accion);
    }
    public function hydrate()
    {
        //
    }
    public function dehydrate()
    {
        //
    }
}
