@php
    $totalDuplicados = $totalImportados = $totalMovimientos = 0;
@endphp
<x-app-layout>
    <header>
        <nav class="flex flex-row gap-2">
            Menu:
            <ul class="flex gap-2">
                <li><a href="{{ route('banca.import.nuevo') }}">Limpiar</a></li>
                <li><a href="{{ route('banca.eliminar.duplicados') }}">Eliminar duplicados</a></li>
                <li><a href="{{ route('banca.export') }}">Exportar</a></li>
            </ul>
        </nav>

    </header>
    <main>
        <div class="flex flex-row w-full justify-between h-64">
            <!-- Primera columna con 80% de ancho -->
            {{-- <div class="col-span-2 border-4 rounded-md"> --}}
            <div class="w-4/5 mx-auto bg-gray-200">
                <table class="table-auto h-full">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Date</th>
                            <th>Libelle</th>
                            <th>arch</th>
                            <th>Montant</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $data)
                            {{-- {{ substr($data->NomArchTras, 10) }} --}}
                            <tr>
                                <td class="justify-end">{{ $data->id }}</td>
                                <td>{{ $data->dateMouvement }}</td>
                                <td class="text-[10px]">{{ $data->libelle }}</td>
                                <td class="text-[12px]">
                                    @if (strlen($data->NomArchTras) > 10)
                                        {{ substr($data->NomArchTras, 0, 5) }}...{{ substr($data->NomArchTras, -9) }}
                                    @else
                                        {{ $data->NomArchTras }}
                                    @endif
                                </td>
                                <td class="text-right {{ $data->montant >= 0 ? 'text-blue-500' : 'text-red-500' }}">
                                    {{ $data->montant }}€
                                </td>
                            </tr>
                        @empty
                            <p>{{ __('No data') }}</p>
                        @endforelse
                        {{ $datas->count() }} Records
                    </tbody>
                </table>
            </div>

            <!-- Segunda columna con 20% de ancho -->
            <div>
                <div class="w-1/5 mx-auto bg-blue-200">
                    <form method="POST" action="{{ route('banca.import') }}" enctype="multipart/form-data">
                        <h3>Importando csv/tsv</h3>
                        @csrf
                        <input placeholder="selecciona archivo(s)" type="file" name="archivo[]" id="archivo"
                            multiple required>
                        <label for="LineaEncabezado">1ra linea de datos</label>
                        <input type="number" name="LineaEncabezado" id="LineaEncabezado" value="8" required>

                        <button type="submit">{{ __('Load') }}</button>
                    </form>
                </div>
                {{-- <div class="w-1/5 mx-auto bg-green-200">
                    <form method="POST" action="{{ route('banca.import') }}" enctype="multipart/form-data">
                        <h3>Eliminar tabla de traspasos</h3>
                        @csrf
                        <x-tw_checkbox name='nuevo' value='0' label='crea desde cero el archivo' />
                        <button type="submit">{{ __('New') }}</button>
                    </form>
                </div> --}}
            </div>
    </main>
</x-app-layout>
