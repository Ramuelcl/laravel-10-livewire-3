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
    public $user, $titulo, $contenido, $image_path, $categoria_id = '', $selectedMarcadores = [];
    public $post, $posts;

    // Ventanas a mostrar
    public $ventana = 0,
        $Listar = 0, $Ingresar = 1, $Editar = 2, $Eliminar = 3;
    public $show = false;

    // controla botones a mostrar
    public $txtTitulo;
    public $btnAgregar = false;
    public $btnEditar = false;
    public $btnCancelar = false;
    public $btnGuardar = false;
    public $btnEliminar = false;
    public $pieVentana = true;

    // datos para la vista en la tabla
    public $tableData = [];
    //
    public function mount()
    {
        $this->user = Auth::user();

        $this->categorias = Categoria::all();
        $this->marcadores = Marcador::all();

        // dump('paso mount antes de las opciones');
        $this->fncOpciones(0, null);
    }

    public function render()
    {
        // dump('paso render para mostrar la ventana');
$this->fncR
        return view('livewire.post.live-formulario', [
            'categorias' => $this->categorias,
            'marcadores' => $this->marcadores,
        ]);
    }

    public function fncSave(Post $post)
    {
        $create = $this->authorize('create', $post);
        $update = $this->authorize('update', $post);
        $delete = $this->authorize('delete', $post);
        // dd(["prueba", $create, $update, $delete]);

        if ($this->ventana < 3) {
            $reglasValidacion = [
                'titulo' => 'required|min:5|max:32',
                'contenido' => 'required|min:5|max:429496',
                'image_path' => '',
                'categoria_id' => 'required|numeric',
            ];
            $obligatorio = 'Este campo es obligatorio.';

            $mensajesValidacion = [
                'titulo.required' => $obligatorio,
                'titulo.min' => 'Este campo debe tener al menos :min caracteres.',
                'titulo.max' => 'Este campo no debe tener más de :max caracteres.',
                'contenido.required' => $obligatorio,
                'contenido.min' => 'Este campo debe tener al menos :min caracteres.',
                'categoria_id.required' => $obligatorio,
            ];
            // $this->validate($reglasValidacion, $mensajesValidacion);
        }
        if ($this->ventana === 3) {
            if ($post)
                $post->delete();
        } elseif ($this->ventana === 2) {
            // $post = Post::find($this->idPost);

            $post->update(
                [
                    'titulo' => $this->titulo,
                    'babosa' => Str::slug($this->titulo),
                    'contenido' => $this->contenido,
                    'image_path' => $this->image_path,
                    'categoria_id' => $this->categoria_id,
                ]
            );
            $post->save();
            $post->marcadores()->sync($this->selectedMarcadores);
        } elseif ($this->ventana === 1) {
            $post = Post::create([
                'user_id' => $this->user,
                'titulo' => $this->titulo,
                'babosa' => Str::slug($this->titulo),
                'contenido' => $this->contenido,
                'image_path' => $this->image_path,
                'categoria_id' => $this->categoria_id,
            ]);
            $post->marcadores()->attach($this->selectedMarcadores);
            // otra forma
            // $post = Post::create([
            //     $this->only('titulo', 'contenido', 'image_path', 'categoria_id')
            // ]);

        }
        $this->fncLimpiaTodo();
    }

    public function fncOpciones($ventana = 0, Post $post = null)
    {
        // controla qué ventana mostrar
        // la primera en mostrar es la de listado registros
        // 0=listar, 1=nuevo, 2=editar, 3=eliminar
        $this->ventana = $ventana;
        $this->post = $post;
        if ($ventana > 0)
            $this->show = true;

        // dump(['funcion fncOpciones', 'ventana' => $ventana, 'post' => $post]);
        if ($ventana === 0) {
            $campos = ['titulo', 'contenido', 'categoria_id'];
            $titulos = ['Título', 'Contenido', 'Categoría', 'Opciones'];
            $this->tableData = [
                'campos' => $campos,
                'titulos' => $titulos,
                'btnAgregar' => false,
                'btnEditar' => false,
                'btnEliminar' => false,
                'azar' => fncCadenaAlfabeticaAleatoria(),

            ];

            if ($this->user->hasRole('admin')) {
                // Datos específicos para el rol de administrador
                $this->tableData['btnAgregar'] = true;
                $this->tableData['btnEditar'] = true;
                $this->tableData['btnEliminar'] = true;
            } else {
                // Datos específicos para otros roles (por ejemplo, usuarios normales)
                $this->tableData['btnAgregar'] = true;
                $this->tableData['btnEditar'] = true;
                $this->tableData['btnEliminar'] = false; // Obtener datos para otros roles
            }
            // dump('generó datos para el listado');
        } elseif ($ventana === 1) {
            $this->fncLimpiarCampos();
        } elseif ($ventana === 2 || $ventana === 3) {
            // dump($post);

            $this->titulo = $this->post->titulo;
            $this->contenido = $this->post->contenido;
            $this->image_path = $this->post->image_path;
            $this->categoria_id = $this->post->categoria_id;
            $this->selectedMarcadores[] = $this->post->Marcadores;
        }
        $this->fncAlternarVentana($ventana);
    }

    public function fncLimpiaTodo()
    {
        $this->reset(['show', 'ventana']);

        $this->fncLimpiarCampos();
        $this->fncResetPage();
    }
    public function fncLimpiarCampos()
    {
        $this->reset(['idPost', 'titulo', 'contenido', 'image_path', 'categoria_id', 'selectedMarcadores']);
    }
    public function fncResetPage($pageName = 'page')
    {
        // $this->setPage(1, $pageName);
    }

    function getColumnValue($row, $columnName)
    {
        if ($columnName === 'categoria_id') {
            return $row->categoria->nombre;
        }

        return $row->$columnName;
    }

    public function fncRefresca()
    {
        $this->posts = Post::latest()->with('categoria')->get();
    }

    public function fncAlternarVentana()
    {
        $this->txtTitulo = '';
        $this->btnAgregar = false;
        $this->btnEditar = false;
        $this->btnEliminar = false;
        $this->btnCancelar = false;
        $this->btnGuardar = false;
        $this->pieVentana = true;

        if ($this->ventana === 0) {
            $this->txtTitulo = 'Listado';
            $this->btnAgregar = true;
            $this->btnEditar = true;
            $this->btnEliminar = true;
            $this->pieVentana = false;
            $this->tableData['txtTitulo'] = $this->txtTitulo;
            $this->tableData['btnAgregar'] = $this->btnAgregar;
            $this->tableData['btnCancelar'] = $this->btnCancelar;
            $this->tableData['btnGuardar'] = $this->btnGuardar;
            $this->tableData['btnEliminar'] = $this->btnEliminar;
            $this->tableData['pieVentana'] = $this->pieVentana;
        } elseif ($this->ventana === 1) {
            $this->txtTitulo = 'Nuevo registro';
            $this->btnCancelar = true;
            $this->btnGuardar = true;
        } elseif ($this->ventana === 2) {
            $this->txtTitulo = 'Edición';
            $this->btnCancelar = true;
            $this->btnGuardar = true;
        } elseif ($this->ventana === 3) {
            $this->txtTitulo = 'Realmente desea ELIMINAR este registro ?';
            $this->btnCancelar = true;
            $this->btnEliminar = true;
        }
        // dump($this->ventana);
    }
}
