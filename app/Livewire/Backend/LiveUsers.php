<?php

namespace App\Livewire\Backend;

use App\Models\User;
use Livewire\Component;
//
use Livewire\WithFileUploads;

class LiveUsers extends Component
{
    use WithFileUploads;

    //
    public $users;
    public $name, $email, $password, $profile_photo_path, $is_active;

    protected $listeners = ['searchApplied', 'activeApplied'];

    public function render()
    {
        return view('livewire.backend.live-users'); //, ['users' => $this->users]
    }

    public function fncGuardar()
    {
        // sleep(20);
        $validate = $this->validate([
            'name' => 'required|min:5|max:32',
            'email' => 'required|email|min:5|max:32|unique:users,email',
            'password' => 'required|min:5',
            'profile_photo_path' => 'nullable|image|max:1024',

        ], [
            'name.required' => 'El nombre es requerido',
            'name.min' => 'ingresar al menos 5 caracteres',
            'name.max' => 'máximo 32 caracteres',
            //
            'email.required' => 'El mail es requerido',
            'email.email' => 'debe ser: nombre@proveeder.tipo',
            'email.min' => 'ingresar al menos 5 caracteres',
            'email.max' => 'máximo 32 caracteres',
            'email.unique' => 'ese mail ya esta siendo usado',
            //
            'password.required' => 'La contraseña es requerida',
            'password.min' => 'ingresar al menos 5 caracteres',
            //
            'profile_photo_path.image' => 'tipo debe ser una imagen',
            'profile_photo_path.max' => 'el tamaño del archivo se ha excedido',
        ]);
        // dd($validate);
        if ($this->is_active == null)
            $this->is_active = false;

        $file = null;
        $path = 'images/avatars/';
        if ($this->profile_photo_path) {

            $file = 'user-' . uniqid() . '.' . $this->profile_photo_path->extension($this->profile_photo_path);
            //
            $paso = fncCrearDirectorio($path);
            //
            $this->profile_photo_path->storeAs('public/' . $path, $file);
            // dd($paso, $file, $path);
        }

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'profile_photo_path' => $path . $file,
            'is_active' => $this->is_active,
        ])->save();
        session()->flash('messages', 'usuario creado satisfactoriamente');
    }
}
