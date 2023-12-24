@props([
    'name' => null,
    'array' => [],
    'disabled' => false,
    'label' => '',
    'multiple' => false,
    'value' => [],
    'class' => '',
    'classFix' =>
        'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-md',
    'contentClasses' => 'py-1 bg-gray-100 dark:bg-gray-700',
    'align' => 'top',
])

{{-- resources\views\components\tw_select.blade.php --}}
{{-- @dd(['array' => $array, 'value' => $value]) --}}
@if (!$name)
    <div class="text-red-500">El nombre es nulo para tw_select.</div>
@else
    <div class="{{ $align == 'top' ? 'flex-col' : '' }}">
        @if ($label)
            <x-tw_label name="{{ $name }}" label="{{ $label }}"
                class="{{ $align === 'left' ? '' : 'pl-2' }}" />
        @endif

        <select id="{{ $name }}" name="{{ $name }}" {{ $disabled ? 'disabled' : '' }}
            @class([
                $class,
                $classFix,
                $contentClasses,
                "@error($name) peer-invalid @enderror",
            ]) {{ $multiple ? 'multiple' : '' }}>
            <option value="" disabled>{{ $multiple ? 'Seleccione uno o más... ctrl+click' : 'Seleccione...' }}
            </option>
            {{ $slot }}
        </select>

        <x-tw_error name="{{ $name }}" class="{{ $align == 'left' ? '' : 'pl-2' }}"></x-tw_error>
    </div>
@endif
