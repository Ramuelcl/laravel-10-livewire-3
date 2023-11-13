<div>
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
            <div class="relative m-[2px] mb-3 mr-5 float-left w-1/3">
                <label for="search" class="sr-only">Search </label>
                {{-- {{ $search }} --}}
                <x-input wire:model.live="search" id="search" type="search" placeholder="Search..." icon="search"
                    class="block w-64 rounded-lg border dark:border-none dark:bg-neutral-600 py-2 pl-10 pr-4 text-sm focus:border-blue-400 focus:outline-none focus:ring-1 focus:ring-blue-400" />

            </div>
        @endif
        <!-- select only actives -->
        @if ($onActive)
            {{-- {{ $chkActivos ? '+' : '-' }} --}}
            <div class="relative m-[2px] mb-3 mr-5 float-left w-1/3">
                <x-checkbox wire:model.live="chkActivos" label="Activos ?" />
            </div>
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
                    Acciones
                </th>
            </tr>
        </thead>

        <!-- Table body -->
        <tbody>
            @foreach ($users as $user)
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
                        <img src="{{ Storage::url('public/' . $user->profile_photo_path) }}" class="w-5">
                    </td>
                    <td>
                        <x-button primary>Editar</x-button>
                        <x-button secondary>Eliminar</x-button>
                    </td>
                </tr>
            @endforeach

        </tbody>

        <!-- Table footer -->
        <tfoot class="border-t-2 dark:border-neutral-600">
            <tr>
                <td></td>
                <td class="px-6 py-2 border-x dark:border-neutral-600">Usuarios:
                    {{ $this->totalUsuarios() }}
                </td>
            </tr>
        </tfoot>

    </table>
    {{-- {{ $this->users->links() }} --}}
    <nav class="mt-5 flex items-center justify-between text-sm" aria-label="Page navigation example">
        <p>
            Showing <strong>1-{{ $this->xPag }}</strong> of <strong>{{ $this->totalUsuarios() }}</strong>
        </p>

        <ul class="list-style-none flex">
            <li>
                <a class="relative block rounded bg-transparent px-3 py-1.5 text-sm text-neutral-600 transition-all duration-300 hover:bg-neutral-100 dark:text-white dark:hover:bg-neutral-700 dark:hover:text-white"
                    href="#!">
                    Previous
                </a>
            </li>

            <li>
                <a class="relative block rounded bg-transparent px-3 py-1.5 text-sm text-neutral-600 transition-all duration-300 hover:bg-neutral-100 dark:text-white dark:hover:bg-neutral-700 dark:hover:text-white"
                    href="#!">
                    Next
                </a>
            </li>
        </ul>
    </nav>

</div>
