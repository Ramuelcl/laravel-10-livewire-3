<?php
// app\livewire\post\LiveFormulario.php
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
    public $user,
        $titulo,
        $contenido,
        $imagen,
        $categoria_id = '',
        $selectedMarcadores = [];
    public $post, $posts;

    // Ventanas a mostrar
    public $ventana = 0,
        $Listar = 0,
        $Ingresar = 1,
        $Editar = 2,
        $Eliminar = 3;
    public $muestraModal = false;

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
        // En tu controlador
        $this->user = Auth::user();

        $this->categorias = Categoria::all();
        $this->marcadores = Marcador::all();
        $this->posts = Post::latest()
            ->with('categoria')
            ->get();
        $this->fncOpciones();
    }

    public function render()
    {
        $this->alternarVentana();

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

        if ($this->ventana === $this->Ingresar) {
            $post = Post::create([
                'user_id' => 1,
                'titulo' => $this->titulo,
                'babosa' => Str::slug($this->titulo),
                'contenido' => $this->contenido,
                'imagen' => $this->imagen,
                'categoria_id' => $this->categoria_id,
            ]);

            $post->marcadores()->attach($this->selectedMarcadores);
            // Actualiza la marca de tiempo 'updated_at'
            $post->touch();
            $post->marcadores()->touch();

            $this->limpiaTodo();
        }
    }

    public function fncOpciones($ventana = 0, Post $post)
    {
        $this->ventana = $ventana;
        $this->post = $post;
        dd($post);
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
        } elseif ($ventana === 1) {
            $this->limpiarCampos();
        } elseif ($ventana === 2 || $ventana === 3) {
            // $this->post = Post::findOrFail($id);
            // $post = Dato0::where('id', $id)->with('ciudad.pais')->first();
            // $ciudad = $post->ciudad;
            // $post->toArray();
            // dump($post);

            $this->titulo = $this->post->titulo;
            $this->contenido = $this->post->contenido;
            $this->imagen = $this->post->imagen;
            $this->categoria_id = $this->post->categoria_id;
            $this->selectedMarcadores[] = $this->post->Marcadores;

            // dd($this->idPost, $this->pais_id);
        }
    }

    public function limpiaTodo()
    {
        $this->ventana = 0;
        $this->limpiaCampos();
        $this->resetPage();
    }
    public function limpiaCampos()
    {
        $this->reset(['titulo', 'contenido', 'imagen', 'categoria_id', 'selectedMarcadores']);
    }
    public function resetPage($pageName = 'page')
    {
        // $this->setPage(1, $pageName);
    }
    // En tu controlador o archivo de utilidades
    function getColumnValue($row, $columnName)
    {
        if ($columnName === 'categoria_id') {
            return $row->categoria->nombre;
        }

        return $row->$columnName;
    }
    public function alternarVentana()
    {
        $this->txtTitulo = '';
        $this->btnAgregar = false;
        $this->btnEditar = false;
        $this->btnEliminar = false;
        $this->btnCancelar = false;
        $this->btnGuardar = false;
        $this->pieVentana = true;

        if ($this->ventana == 0) {
            $this->txtTitulo = 'Listado';
            $this->btnAgregar = true;
            $this->btnEditar = true;
            $this->btnEliminar = true;
            $this->pieVentana = false;
        } elseif ($this->ventana == 1) {
            $this->txtTitulo = 'Nuevo registro';
            $this->btnCancelar = true;
            $this->btnGuardar = true;
        } elseif ($this->ventana == 2) {
            $this->txtTitulo = 'Edición';
            $this->btnCancelar = true;
            $this->btnGuardar = true;
        } elseif ($this->ventana == 3) {
            $this->txtTitulo = 'Realmente desea ELIMINAR este registro ?';
            $this->btnCancelar = true;
            $this->btnEliminar = true;
        }
        $this->tableData['txtTitulo'] = $this->txtTitulo;
        $this->tableData['btnAgregar'] = $this->btnAgregar;
        $this->tableData['btnCancelar'] = $this->btnCancelar;
        $this->tableData['btnGuardar'] = $this->btnGuardar;
        $this->tableData['btnEliminar'] = $this->btnEliminar;
        $this->tableData['pieVentana'] = $this->pieVentana;

        // dump($this->ventana);
    }
}
que carga esta vista:
<!-- resources\views\livewire\post\live-formulario.blade.php -->
<div class="m-2">
    @if ($ventana == $Listar)
        <div class="bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow rounded-lg p-2">
            <x-tablas :data="$posts" :td="$tableData" />
        </div>
    @elseif($ventana == $Ingresar || $ventana == $Editar)
        <div class="bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow rounded-lg p-2 mb-8">
            {{ $txtTitulo }}
            <form wire:submit="fncSave()" class="border-b-4">
                <div class="mb-4">
                    <x-input wire:model="titulo" label="Título" placeholder="título del Post" />
                </div>
                <div class="mb-4">
                    <x-input-label>Contenido</x-input-label>
                    <x-textarea class="w-full" wire:model="contenido"></x-textarea>
                </div>
                <div class="mb-4 hidden">
                    <x-input-label>Imagen</x-input-label>
                    <x-input class="w-full" wire:model="imagen" disabled></x-input>
                </div>
                <div class="flex justify-between gap-4">
                    <div class="mb-4 w-1/2">
                        <x-input-label>Categoría</x-input-label>
                        <x-select1 class="w-full" wire:model="categoria_id">
                            @foreach ($categorias as $categoria0)
                                {{-- @dd($categoria0) --}}
                                <option value="{{ $categoria0->id }}">{{ $categoria0->nombre }}</option>
                            @endforeach
                        </x-select1>
                    </div>
                    <div class="mb-4 w-1/2">
                        <x-input-label>Marcadores</x-input-label>
                        <x-select1 :multiple="true" class="w-full" wire:model="selectedMarcadores">
                            @foreach ($marcadores as $marcador)
                                <option value="{{ $marcador->id }}" style="background-color:{{ $marcador->hexa }}">
                                    {{ $marcador->nombre }}
                                </option>
                            @endforeach
                        </x-select1>
                    </div>

                </div>
                <div class="flex justify-end border-t-4">
                    <x-secondary-button wire:click="fncOpciones(0)" class="mx-6">Cancelar</x-secondary-button>

                    <x-primary-button color="red"
                        wire:click="fncOpciones({{ $ventana === 1 ? 0 : $post->id }})">{{ $ventana === 1 ? 'Crear' : 'Editar' }}</x-primary-button>
                </div>
            </form>
        </div>
    @elseif($ventana == $Eliminar)
        {{-- comentario --}}
    @endif
    @if ($muestraModal)
        <div name="modal" class="bg-gray-800 bg-opacity-25 fixed inset-0">
            <div class="py-6">
                <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 ">
                    <div class="bg-white border-blue-500 shadow rounded-lg p-6">
                        {{ $slot ?? '' }}
                        <div
                            class="bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow rounded-lg p-2 mb-8">
                            {{ $txtTitulo }}
                            <form wire:submit="fncSave()">
                                <div class="mb-4">
                                    <x-input wire:model="titulo" label="Título" placeholder="título del Post" />
                                </div>
                                <div class="mb-4">
                                    <x-input-label>Contenido</x-input-label>
                                    <x-textarea class="w-full" wire:model="contenido"></x-textarea>
                                </div>
                                <div class="mb-4 hidden">
                                    <x-input-label>Imagen</x-input-label>
                                    <x-input class="w-full" wire:model="imagen" disabled></x-input>
                                </div>
                                <div class="flex justify-between gap-4">
                                    <div class="mb-4 w-1/2">
                                        <x-input-label>Categoría</x-input-label>
                                        <x-select1 class="w-full" wire:model="categoria_id">
                                            @foreach ($categorias as $categoria0)
                                                {{-- @dd($categoria0) --}}
                                                <option value="{{ $categoria0->id }}">{{ $categoria0->nombre }}
                                                </option>
                                            @endforeach
                                        </x-select1>
                                    </div>
                                    <div class="mb-4 w-1/2">
                                        <x-input-label>Marcadores</x-input-label>
                                        <x-select1 :multiple="true" class="w-full" wire:model="selectedMarcadores">
                                            @foreach ($marcadores as $marcador)
                                                <option value="{{ $marcador->id }}"
                                                    style="background-color:{{ $marcador->hexa }}">
                                                    {{ $marcador->nombre }}
                                                </option>
                                            @endforeach
                                        </x-select1>
                                    </div>

                                </div>

                                <hr>
                                <div class="flex justify-end">
                                    <x-secondary-button class="mx-6">Cancelar</x-secondary-button>

                                    <x-primary-button
                                        color="red">{{ $ventana === 1 ? 'Crear' : 'Editar' }}</x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
el cual carga este componente blade sin controlador:
<!-- views/components/tablas.blade.php -->
@props(['data', 'td'])
{{-- @dd($td); --}}

<table class="table-auto w-full">
    <div class="flex justify-between">
        {{ $td['txtTitulo'] }}
        @if ($td['btnAgregar'])
            <x-button rounded primary label="Agregar" icon="plus" {{ $this->fncOpciones(1) }} />
        @endif
    </div>
    <thead class="border-b-2 border-cyan-500">
        <tr>
            @foreach ($td['titulos'] as $columnTitle)
                <th class="text-left">{{ $columnTitle }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        {{-- @dd($data) --}}
        @foreach ($data as $row)
            <tr>
                @foreach ($td['campos'] as $columnName)
                    <td wire:key="{{ $td['azar'] }}-{{ $row->id }}">
                        {{ $this->getColumnValue($row, $columnName) }}
                    </td>
                @endforeach
                @if ($td['btnEditar'])
                    <td><x-button rounded positive label="Editar" icon="pencil"
                            {{ $this->parent->fncOpciones(2, $row->id) }} /></td>
                @endif
                @if ($td['btnEliminar'])
                    <td><x-button rounded negative label="Eliminar" icon="minus"
                            {{ $this->parent->fncOpciones(3, $row->id) }} /></td>
                @endif
            </tr>
        @endforeach

    </tbody>
    <tfoot class="border-t-2  border-cyan-500">
        <tr>
            <td>Pie de página 1</td>
            <td>Pie de página 2</td>
            <!-- Agrega más elementos al pie de página -->
        </tr>
    </tfoot>
</table>

necesito que este último ejecute una funcion con los parametros en LiveFormulario.php, cómo lo hago?
