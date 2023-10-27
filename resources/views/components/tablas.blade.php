<!-- views/components/tablas.blade.php -->
@props(['data', 'td'])
{{-- @dd($td); --}}

<table class="table-auto w-full">
    <div class="flex justify-end">
        @if ($td['agregar'])
            <x-button rounded primary label="Agregar" icon="plus" />
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
                    <td>{{ $this->getColumnValue($row, $columnName) }}</td>
                @endforeach
                @if ($td['editar'])
                    <td><x-button rounded positive label="Editar" icon="pencil" /></td>
                @endif
                @if ($td['eliminar'])
                    <td><x-button rounded negative label="Eliminar" icon="minus" /></td>
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
