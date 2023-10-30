<!-- resources\views\livewire\post\live-formulario.blade.php -->
<div class="m-2">

    <div class="bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow rounded-lg p-2">
        <x-tablas :data="$posts" :td="$tableData" />
    </div>

    {{-- <div class="bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow rounded-lg p-2 mb-8">
             @dump(['ventana' => $ventana, 'txtTitulo' => $txtTitulo]) --}}
    @if ($ventana > 0)
        <x-modal2 name="miModal" show="{{ $show }}">
            {{ $txtTitulo }}
            <form wire:submit="fncSave()" class="border-b-4">
                <fieldset {{ $ventana === 3 ? 'disabled' : '' }}>

                    <div class="mb-4">
                        <x-input wire:model="titulo" label="Título" placeholder="título del Post" />
                    </div>
                    <div class="mb-4">
                        <x-input-label>Contenido</x-input-label>
                        <x-textarea class="w-full" wire:model="contenido"></x-textarea>
                    </div>
                    <div class="mb-4 hidden">
                        <x-input-label>Imagen</x-input-label>
                        <x-input class="w-full" wire:model="image_path" disabled></x-input>
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
                </fieldset>
                <div class="flex justify-end border-t-4">
                    <x-secondary-button wire:click="$set('show', false)" class="mx-6">Cancelar</x-secondary-button>

                    <x-primary-button color="red"
                        wire:click="fncSave({{ $ventana === 1 ? 0 : $post->id }})">{{ ($ventana === 1 ? 'Crear' : $ventana === 2) ? 'Editar' : 'Eliminar' }}</x-primary-button>
                </div>
            </form>
        </x-modal2>
    @endif
</div>
