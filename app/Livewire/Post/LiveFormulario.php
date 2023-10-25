<?php

namespace App\Livewire\Post;

use App\Models\backend\Categoria;
use App\Models\backend\Marcador;
use App\Models\posts\Post;
use Livewire\Component;
use Illuminate\Support\Str;

class LiveFormulario extends Component
{
    public $idPost;
    public $categorias, $marcadores;
    public $titulo, $contenido, $imagen, $categoria_id = '', $selectedMarcadores = [];
    public $posts;

    // Ventanas a mostrar
    public $ventana = 0, $Listar = 0, $Ingresar = 1, $Editar = 2, $Eliminar = 3;

    public function mount()
    {
        $this->categorias = Categoria::all();
        $this->marcadores = Marcador::all();
        $this->posts = Post::all();
    }

    public function render()
    {
        return view('livewire.post.live-formulario', [
            'categorias' => $this->categorias,
            'marcadores' => $this->marcadores,
        ]);
    }

    public function fncSave()
    {
        $post = Post::create([
            'user_id' => 1,
            'titulo' => $this->titulo,
            'babosa' => Str::slug($this->titulo),
            'contenido' => $this->contenido,
            'imagen' => $this->imagen,
            'categoria_id' => $this->categoria_id,
        ]);

        // otra forma
        // $post = Post::create([
        //     $this->only('titulo', 'contenido', 'imagen', 'categoria_id')
        // ]);

        $post->marcadores()->attach($this->selectedMarcadores);
        // Actualiza la marca de tiempo 'updated_at'
        $post->touch();

        // dd([
        //     'titulo' => $this->titulo,
        //     'contenido' => $this->contenido,
        //     'imagen' => $this->imagen,
        //     'categoria_id' => $this->categoria_id,
        //     'selectedMarcadores' => $this->selectedMarcadores,
        // ]);
    }

    public function limpiaTodo()
    {
        $this->limpiaCampos();
    }
    public function limpiaCampos()
    {
        $this->reset(['titulo', 'contenido', 'imagen', 'categoria_id', 'selectedMarcadores']);
    }
}
