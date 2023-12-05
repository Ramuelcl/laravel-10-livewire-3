<?php

namespace App\Livewire\Backend\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class LiveForms extends Component
{
    use WithFileUploads;

    //
    public $users;
    public $name, $email, $password, $profile_photo_path, $is_active;

    public function mount()
    {
    }

    public function render()
    {
        return view('livewire.backend.users.live-forms');
    }

    public function fncGuardar($opcion = 1) // 1=nuevo, 2=edicion, 3=eliminacion
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

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'profile_photo_path' => $path . $file,
            'is_active' => $this->is_active,
        ])->save();

        session()->flash('messages', "usuario " . $opcion == 1 ? 'creado' : 'editado' . " satisfactoriamente");

        $this->fncLimpiaTodo();

        $this->event('eventList');
    }

    public function fncLimpiaTodo()
    {
        $this->fncLimpiaCampos();
        $this->reset(['name', 'email', 'password', 'profile_photo_path', 'is_active']);
    }
    public function fncLimpiaCampos()
    {
        $this->reset(['name', 'email', 'password', 'profile_photo_path', 'is_active']);
    }
    public function getAccess(User $user, $action = 1) //1=access, 2=create, 3=read, 4=update, 5=delete, 6=publish, 7=unpublish, 8=printer, 9=export
    {
        // dump($user);
        $return = false;
        if ($this->user->hasRole('admin') || $this->user->hasRole('super-admin')) {
            $return = true;
        } else {
            // Datos específicos para otros roles (por ejemplo, usuarios normales)
            $return = ($user === $this->user_id_in) ? true : false;
        }

        // dump($user, $this->user_id_in);
        // Obtener datos para otros roles
        return $return;
    }
}
