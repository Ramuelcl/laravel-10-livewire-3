<?php

namespace App\Livewire\Backend;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class LiveListUsers extends Component
{
    use WithPagination;

    public $onSearch, $search = '', $onActive, $chkActivos;
    public $onPag, $xPags = [5, 10, 25, 50], $xPag = 5;
    public $sortField = 'id', $sortDir = 'desc';

    public $users;

    public function mount($onSearch = true, $onActive = true, $onPag = true)
    {
        $this->onSearch = $onSearch;
        $this->onActive = $onActive;
        $this->onPag = $onPag;
    }


    public function render()
    {        // $this->users = User::latest()->get();
        //
        $this->users = User::where('id', '>', '0')
            ->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $search = '%' . $this->search . '%';
                    $query->where('id', 'like', $search)
                        ->orWhere('name', 'like', $search)
                        ->orWhere('email', 'like', $search);
                });
            })
            ->when($this->chkActivos, function ($query) {
                return $query->Is_active();
            })
            ->orderBy($this->sortField, $this->sortDir)
            // ->get();
            ->paginate($this->xPag)
            ->toBase(); // Convierte a una colección Eloquent;
        // dd($this->users);

        return view('livewire.backend.live-list-users', [
            'users' => $this->users,
        ]);
    }

    public function totalUsuarios()
    {
        return User::count();
    }
}
