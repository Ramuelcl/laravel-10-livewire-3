@props([
    'name' => 'button',
    'type' => 'button',
    'bgColor' => 'blue',
    'class' => '',
    'classFix' => '',
    'icon' => null,
    'click' => '',
])
{{-- resources\views\components\tw_button.blade.php --}}
@php
    $classFix = 'inline-flex items-center justify-center min-w-20 bg-' . $bgColor . '-500 text-' . $bgColor . '-100 hover:bg-' . $bgColor . '-600 active:bg-' . $bgColor . '-700 focus:outline-none focus:ring focus:ring-' . $bgColor . '-300 rounded-md p-2';

    if ($icon) {
        $iconPath = storage_path('app/public/images/app/icons/outline/' . $icon . '.svg');
        $icon = file_exists($iconPath) ? file_get_contents($iconPath) : null;
    }
@endphp
<button id="{{ $name }}" name="{{ $name }}" @class([$classFix, $class]) type="{{ $type }}"
    wire.click="$click">
    @if (isset($icon))
        {!! $icon !!}
    @endif
    {{ $slot }}
</button>
