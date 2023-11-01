<?php

namespace App\Livewire\Post;

use App\Models\backend\Categoria;
use App\Models\backend\Marcador;
use App\Models\posts\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;

class LiveFormulario extends Component
{
    public $idPost;
    public $categorias, $marcadores;
    public $user_id, $titulo, $contenido, $image_path, $categoria_id = '', $selectedMarcadores = [], $selectedMarcadores3 = [];
    public $post, $posts;
    public $user, $user_id_in;

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
    static $paso = 0;

    // datos para la vista en la tabla
    public $tableData = [];
    //
    public function mount()
    {
        $this->user_id_in = 1; //
        $this->user = Auth::user();
        // dd($this->user_id);
        $this->categorias = Categoria::all(['id', 'nombre'])->toArray();
        $this->marcadores = Marcador::where('is_active', true)->get(['id', 'nombre', 'hexa'])->toArray();

        // dd('paso mount antes de las opciones', $this->categorias, $this->marcadores);
        $this->fncOpciones(0, null);
    }

    public function render()
    {
        $this->fncRefresca();

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
        dd($post, ["prueba", $create, $update, $delete]);

        if ($this->ventana < 3) {
            $reglasValidacion = [
                'titulo' => 'required|min:5|max:32|unique:posts,nombre',
                'contenido' => 'required|min:5|max:429496',
                'image_path' => '',
                'categoria_id' => 'required|exist:categorias,id',
                'selectedMarcadores' => 'required|array|min:1|max:3'
            ];

            $obligatorio = 'Este dato es obligatorio.';
            $mensajesValidacion = [
                'titulo.required' => $obligatorio,
                'titulo.min' => 'Este campo debe tener al menos :min caracteres.',
                'titulo.max' => 'Este campo no debe tener más de :max caracteres.',
                'contenido.required' => $obligatorio,
                'contenido.min' => 'Este campo debe tener al menos :min caracteres.',
                'categoria_id.required' => $obligatorio,
            ];
            $this->validate($reglasValidacion, $mensajesValidacion);
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
            // dd($this->selectedMarcadores);
            $post->save();

            $post->marcadores()->sync($this->selectedMarcadores);
        } elseif ($this->ventana === 1) {
            $post = Post::create([
                'user_id' => $this->user_id_in,
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
            $campos = ['titulo', 'contenido', 'categoria_id', 'selectedMarcadores'];
            $titulos = ['Título', 'Contenido', 'Categoría', 'Marcadores', 'Opciones'];
            $this->tableData = [
                'campos' => $campos,
                'titulos' => $titulos,
                'btnAgregar' => false,
                'btnEditar' => false,
                'btnEliminar' => false,
                'azar' => fncCadenaAlfabeticaAleatoria(),

            ];

            // dump('generó datos para el listado');
        } elseif ($ventana === 1) {
            $this->fncLimpiarCampos();
        } elseif ($ventana === 2 || $ventana === 3) {
            // dump($post);
            $this->titulo = $this->post->titulo;
            $this->contenido = $this->post->contenido;
            $this->image_path = $this->post->image_path;
            $this->categoria_id = $this->post->categoria_id;

            $this->selectedMarcadores = $post->marcadores;
            $this->selectedMarcadores = $this->selectedMarcadores->pluck('nombre', 'id')->toArray();
            // dd($this->selectedMarcadores, $this->selectedMarcadores3);
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

    public function getColumnValue($row, $columnName)
    {
        if ($columnName === 'categoria_id') {
            return $row->categoria->nombre;
        } elseif ($columnName === 'selectedMarcadores') {
            $val = null;
            $marcadores = $row->marcadores;
            // dd(['selectedMarcadores' => $this->selectedMarcadores, 'columnName' => $columnName, 'row' => $row,]);
            foreach ($marcadores as $key => $value) {
                $val .= $value['nombre'] . ', ';
            }
            return substr($val, 0,  -2);
        }
        return $row->$columnName;
    }

    public function getAccess($creador)
    {
        // dump($creador);
        $return = false;
        if ($this->user->hasRole('admin')) {
            $return = true;
        } else {
            // Datos específicos para otros roles (por ejemplo, usuarios normales)
            $return = ($creador === $this->user_id_in) ? true : false;
        }

        // dump($creador, $this->user_id_in);
        // Obtener datos para otros roles
        return $return;
    }

    // public function fncChkLabel($id, $txt)
    // {
    //     return "<input type='checkbox' value=$id/>$txt";
    // }

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
