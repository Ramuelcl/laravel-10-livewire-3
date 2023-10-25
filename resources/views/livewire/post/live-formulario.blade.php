<div class="m-2">
    Post
    @if (config('constantes.LISTAR'))
        <div class="bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow rounded-lg p-2">
            @foreach ($posts as $post)
            @endforeach
        </div>
    @elseif(config('constantes.INGRESAR') || config('constantes.EDITAR'))
        @if (config('constantes.INGRESAR'))
            <div class="bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow rounded-lg p-2 mb-8">
                <form wire:submit="fncSave()">
                    <div class="mb-4">
                        <x-input-label>Título</x-input-label>
                        <x-text-input class="w-full" wire:model="titulo" required></x-text-input>
                        <x-input wire:model="titulo" label="Título" placeholder="título del Post" required />
                    </div>
                    <div class="mb-4">
                        <x-input-label>Contenido</x-input-label>
                        <x-textarea class="w-full" wire:model="contenido" required></x-textarea>
                    </div>
                    <div class="mb-4 hidden">
                        <x-input-label>Imagen</x-input-label>
                        <x-text-input class="w-full" wire:model="imagen" disabled></x-text-input>
                    </div>
                    <div class="flex justify-between gap-4">
                        <div class="mb-4 w-1/2">
                            <x-input-label>Categoría</x-input-label>
                            <x-select class="w-full" wire:model="categoria_id">
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="mb-4 w-1/2">
                            <x-input-label>Marcadores</x-input-label>
                            <x-selectMultiple class="w-full" wire:model="selectedMarcadores">
                                @foreach ($marcadores as $marcador)
                                    <option value="{{ $marcador->id }}" style="background-color:{{ $marcador->hexa }}">
                                        {{ $marcador->nombre }}
                                    </option>
                                @endforeach
                            </x-selectMultiple>
                        </div>
                    </div>
                    {{-- <div class="mb-4">
                <x-input-label>Marcadores</x-input-label>
                <ul>
                    @foreach ($marcadores as $marcador)
                        <li>
                            <label>
                                <x-checkbox name="marcadores[]" value="{{ $marcador->id }}">
                                    <span class="ml-2"> {{ $marcador->nombre }}</span>
                                </x-checkbox>
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div> --}}
                    <hr>
                    <div class="flex justify-end">
                        <x-primary-button>Crear</x-primary-button>
                    </div>
                </form>
            </div>
        @elseif(config('constantes.EDITAR'))
            //
        @endif
    @elseif(config('constantes.ELIMINAR'))
        //
    @endif
</div>
