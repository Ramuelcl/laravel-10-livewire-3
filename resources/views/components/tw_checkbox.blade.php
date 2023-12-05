@props([
    'name' => null,
    'disabled' => false,
    'label' => '',
    'value' => '',
    'class' => '',
    'classFix' =>
        'h-5 w-5 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-md',
])

@if (!$name)
    <div class="text-red-500">El nombre es nulo en tw_checkbox.</div>
@else
    <div @class(['flex items-center', $class])>
        @if ($label)
            <x-tw_label name="{{ $name }}" label="{{ $label }}" class="mr-2" />
        @endif
        <input name="{{ $name }}" type="hidden" value="0">
        <input name="{{ $name }}" type="checkbox" @checked(old($name, $value ?? false)) value="1"
            id="{{ $name }}" {{ $disabled ?? 'disabled' }} role="switch" @class([$class, $classFix])>
    </div>
@endif
