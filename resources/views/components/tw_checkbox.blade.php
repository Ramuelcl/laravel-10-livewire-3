@props([
    'name' => null,
    'disabled' => false,
    'label' => '',
    'value' => '',
    'class' => '',
    'classFix' =>
        'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-md',
])

@if (!$name)
    <div class="text-red-500">El nombre es nulo en tw_checkbox.</div>
@else
    <div @class(['flex items-center', $class])>
        @if ($label)
            <x-tw_label name="{{ $name }}" label="{{ $label }}" class="form-check-label mr-2" />
        @endif
        <input name="{{ $name }}" type="hidden" value="0">
        <input name="{{ $name }}" type="checkbox" @checked(old($name, $value ?? false)) value="1"
            id="{{ $name }}" {{ $disabled ?? 'disabled' }} role="switch" @class([
                $class,
                $classFix,
                "form-input peer @error($name) peer-invalid @enderror",
            ])>
    </div>
@endif
