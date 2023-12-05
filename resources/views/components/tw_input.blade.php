@props([
    'name' => null,
    'disabled' => false,
    'label' => '',
    'placeholder' => '',
    'type' => 'text',
    'value' => '',
    'class' => '',
    'classFix' =>
        'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-md',
    'align' => 'top',
    'width' => '',
    'contentClasses' => 'py-1 bg-white dark:bg-gray-700',
])
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
            $width = 'w-1/3';
            break;
        case '50':
            $width = 'w-1/2';
            break;
        case '75':
            $width = 'w-3/4';
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
                <textarea id="{{ $name }}" name="{{ $name }}" {{ $disabled ?? 'disabled' }}
                    placeholder="{{ $placeholder }}" @class([
                        $class,
                        $classFix,
                        $width,
                        "form-input peer @error($name) peer-invalid @enderror",
                    ])>{{ old($name, $value) }}
                    </textarea>
            @else
                <input id="{{ $name }}" name="{{ $name }}" type="{{ $type }}"
                    {{ $disabled ?? 'disabled' }} value="{{ old($name, $value) }}" placeholder="{{ $placeholder }}"
                    @class([
                        $class,
                        $classFix,
                        $width,
                        "form-input peer @error($name) is-invalid @enderror",
                    ])>
            @endif
            <x-tw_error name="{{ $name }}" class="{{ $align == 'left' ? '' : 'pl-2' }}"></x-tw_error>
        </div>
    </div>
@endif
