@props([
    'id' => 'alert',
    'type' => 'success',
    'class' => '',
    'classFix' => '',
])
{{-- resources\views\components\tw_alert.blade.php --}}
@php
    switch ($type) {
        case 'success':
            $color = 'green';
            break;
        case 'info':
            $color = 'blue';
            break;
        case 'warning':
            $color = 'yellow';
            break;
        case 'danger':
            $color = 'red';
            break;
    }
    $classFix = "bg-$color-300 text-gray-100 w-full text-center items-center px-4 py-2 mt-2 border-2 border-$color-500 rounded-md";
@endphp
<div id="{{ $id }}" @class([$classFix, $class]) role="alert">
    {{ $slot }}
</div>
