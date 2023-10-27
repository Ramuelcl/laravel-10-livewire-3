<?php

namespace App\Livewire\Post;

use App\Models\backend\Categoria;
use App\Models\backend\Marcador;
use App\Models\posts\Post;
use Illuminate\Support\Facades\Auth;
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

    // datos para la vista en la tabla
    public $tableData = [];

    public function mount()
    {
        // En tu controlador
        $user = Auth::user();
        $campos = ['titulo', 'contenido', 'categoria_id'];
        $titulos = ['Título', 'Contenido', 'Categoría', 'Opciones'];
        $this->tableData = [
            'campos' => $campos,
            'titulos' => $titulos,
            'agregar' => false,
            'editar' => false,
            'eliminar' => false,
        ];

        if ($user->hasRole('admin')) {
            // Datos específicos para el rol de administrador
            $this->tableData['agregar'] = true;
            $this->tableData['editar'] = true;
            $this->tableData['eliminar'] = true;
        } else {
            // Datos específicos para otros roles (por ejemplo, usuarios normales)
            $this->tableData['agregar'] = true;
            $this->tableData['editar'] = true;
            $this->tableData['eliminar'] = false; // Obtener datos para otros roles
        }

        $this->categorias = Categoria::all();
        $this->marcadores = Marcador::all();
        $this->posts = Post::with('categoria')->get();;
    }

    public function render()
    {
        return view('livewire.post.live-formulario', [
            'categorias' => $this->categorias,
            'marcadores' => $this->marcadores,
        ]);
    }

    public function fncSave(Post $post)
    {
        $this->authorize('create', $post);
        $this->authorize('update', $post);
        $this->authorize('delete', $post);

        // Resto de la lógica para crear un nuevo post
        // dd([
        //     'titulo' => $this->titulo,
        //     'contenido' => $this->contenido,
        //     'imagen' => $this->imagen,
        //     'categoria_id' => $this->categoria_id,
        //     'selectedMarcadores' => $this->selectedMarcadores,
        // ]);
        if ($this->ventana === $this->Ingresar) {
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

            $this->reset('ventana', 'idPost', 'titulo', 'contenido', 'imagen', 'categoria_id', 'selectedMarcadores');
        }
    }

    public function limpiaTodo()
    {
        $this->limpiaCampos();
    }
    public function limpiaCampos()
    {
        $this->reset(['titulo', 'contenido', 'imagen', 'categoria_id', 'selectedMarcadores']);
    }

    // En tu controlador o archivo de utilidades
    function getColumnValue($row, $columnName)
    {
        if ($columnName === 'categoria_id') {
            return $row->categoria->nombre;
        }

        return $row->$columnName;
    }
}
