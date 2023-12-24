@props([
    'name' => null,
    'disabled' => false,
    'label' => '',
    'placeholder' => '',
    'type' => 'text',
    'value' => '',
    'class' => '',
    'classFix' => @include 'tw_classFix',
    // 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-md',
    // 'classFix' =>
    //     'shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline',
    'align' => 'top',
    'width' => '',
    'contentClasses' => 'py-1 bg-gray-100 dark:bg-gray-700',
])
{{-- resources\views\components\tw_input.blade.php --}}
@php
    switch ($align) {
        case 'left':
            $alignmentClasses = 'flex flex-row gap-2';
            break;
        case 'top':
            $alignmentClasses = 'flex flex-col';
            break;
    }

    switch ($width) {
        case '25':
            $width = 'w-12';
            break;
        case '50':
            $width = 'w-32';
            break;
        case '75':
            $width = 'w-64';
            break;
        default:
            $width = 'w-full';
            break;
    }
@endphp
@if (!$name)
    <div class="text-red-500">El nombre es nulo para tw_input.</div>
@else
    <div class="">
        <div class="z-50 mt-2 {{ $width }} {{ $alignmentClasses }} {{ $align == 'left' ? 'items-center' : '' }}">
            @if ($label)
                <x-tw_label name="{{ $name }}" label="{{ $label }}"
                    class="{{ $align == 'left' ? '' : 'pl-2' }}" />
            @endif
            @if ($type === 'textarea')
                <textarea id="{{ $name }}" name="{{ $name }}" wire:model.live="{{ $name }}"
                    {{ $disabled ?? 'disabled' }} placeholder="{{ $placeholder }}" @class([
                        $class,
                        $classFix,
                        $width,
                        $contentClasses,
                        "form-input peer @error($name) peer-invalid @enderror",
                    ])>{{ old($name, $value) }}
                    </textarea>
            @else
                <input id="{{ $name }}" name="{{ $name }}" wire:model="{{ $name }}"
                    type="{{ $type }}" {{ $disabled ?? 'disabled' }} value="{{ old($name, $value) }}"
                    placeholder="{{ $placeholder }}" @class([
                        $class,
                        $classFix,
                        $width,
                        $contentClasses,
                        "@error($name) peer-invalid @enderror",
                    ])>
            @endif
            <x-tw_error name="{{ $name }}" class="{{ $align == 'left' ? '' : 'pl-2' }}"></x-tw_error>
        </div>
    </div>
@endif
