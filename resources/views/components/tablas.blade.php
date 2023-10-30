@props(['data', 'td'])
<!-- views/components/tablas.blade.php -->
{{-- @dd($td); --}}

<table class="table-auto w-full">
    <div class="flex justify-between">
        {{ $td['txtTitulo'] }}
        @if ($td['btnAgregar'])
            <x-button rounded primary label="Agregar" icon="plus" wire:click="fncOpciones(1)" />
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
                            wire:click="fncOpciones(2, {{ $row }})" /></td>
                @endif
                @if ($td['btnEliminar'])
                    <td><x-button rounded negative label="Eliminar" icon="minus"
                            wire:click="fncOpciones(3, {{ $row }})" /></td>
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
