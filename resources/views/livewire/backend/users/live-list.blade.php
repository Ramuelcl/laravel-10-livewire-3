<div wire:poll.30s>
    <div class="flex justify-between">
        <!-- list pages -->
        @if ($onPag)
            {{-- {{ $xPag ?? null }} --}}
            <div class="relative m-[2px] mb-3 mr-5 float-left w-1/3">
                {{-- <x-input-label>Categoría</x-input-label> --}}
                <x-select1 class="w-1/3" wire:model.live="xPag">
                    @foreach ($xPags as $xPag)
                        {{-- @dd($categoria0) --}}
                        <option value="{{ $xPag }}">{{ $xPag }}</option>
                    @endforeach
                </x-select1>
            </div>
        @endif
        <!-- Search input -->
        @if ($onSearch)
            @livewire('live-search')
        @endif
        <!-- select only actives -->
        @if ($onActive)
            {{-- {{ $chkActivos ? '+' : '-' }} --}}
            <div class="relative m-[2px] mb-3 mr-5 float-left w-1/3">
                <x-checkbox wire:model.live="chkActivos" label="Activos ?" />
            </div>
        @endif
        <!-- select only actives -->
        @if ($onAgregar)
            <x-button rounded primary label="Agregar" icon="plus" wire:click="{{ $this->TabForm(1) }}" />
        @endif
    </div>

    <!-- Table -->
    <table class="min-w-full text-left text-xs whitespace-nowrapd">
        <!-- Table head -->
        <thead
            class="tracking-wider sticky top-0 bg-white dark:bg-neutral-700 outline outline-2 outline-neutral-200 dark:outline-neutral-600 border-t">
            <tr>
                <th scope="col" class="w-1/12 px-6 py-2 border-x dark:border-neutral-600">
                    #
                </th>
                <th scope="col" class="w-1/2 px-6 py-2 border-x dark:border-neutral-600">
                    Nombre
                </th>
                <th scope="col" class="w-1/2 px-6 py-2 border-x dark:border-neutral-600">
                    eMail
                </th>
                <th scope="col" class="w-1/12 px-6 py-2 border-x dark:border-neutral-600">
                    Activo
                </th>
                <th scope="col" class="w-1/12 px-6 py-2 border-x dark:border-neutral-600">
                    Imagen
                </th>
                <th scope="col" class="px-2 py-1 border-x dark:border-neutral-600">
                    Opciones
                </th>
            </tr>
        </thead>

        <!-- Table body -->
        <tbody>
            @foreach ($this->users as $user)
                <tr class="border-b dark:border-neutral-600">
                    <th scope="row" class="px-2 py-2 border-x dark:border-neutral-600">
                        {{ $user->id }}
                    </th>
                    <th scope="row" class="px-2 py-2 border-x dark:border-neutral-600">
                        {{ $user->name }}
                    </th>
                    <td class="px-2 py-2 border-x dark:border-neutral-600">{{ $user->email }}</td>
                    <td class="px-2 py-2 border-x dark:border-neutral-600">
                        {{ $user->is_active ? 'Si' : 'No' }}
                    </td>
                    <td class="px-2 py-2 border-x dark:border-neutral-600">
                        @if (Storage::exists('public/' . $user->profile_photo_path))
                            <img src="{{ Storage::url('public/' . $user->profile_photo_path) }}" class="w-5">
                        @else
                            <img src="{{ Storage::url('public/images/avatars/default.png') }}" class="w-5">
                        @endif
                    </td>
                    <td>
                        <x-button rounded positive label="Editar" icon="pencil"
                            wire:click="fncOpciones(2, {{ $user }})" :disabled="$this->getAccess($user)" />

                        <x-button rounded negative label="Eliminar" icon="minus"
                            wire:click="fncOpciones(3, {{ $user }})" :disabled="$this->getAccess($user)" />
                    </td>
                </tr>
            @endforeach

        </tbody>

        <!-- Table footer -->
        <tfoot class="border-t-2 dark:border-neutral-600">
            <tr>
                <td></td>
                <td class="px-6 py-2 border-x dark:border-neutral-600">{{ $this->users->links() }}
                </td>
            </tr>
        </tfoot>

    </table>
</div>
