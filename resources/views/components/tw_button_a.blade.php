@props([
    'disabled' => false,
    'text' => '',
    'route' => '/',
    'class' => '',
    'width' => '',
    'bgColor' => 'blue',
])
{{-- resources\views\components\tw_button_a.blade.php --}}
@php
    $classFix = "inline-flex items-center justify-center min-w-20 bg-$bgColor-500 hover:bg-$bgColor-600 active:bg-$bgColor-700 focus:outline-none focus:ring focus:ring-$bgColor-300 text-white rounded-md p-2";
@endphp
<a href="{{ route($route) }}" @class([$classFix, $class])>
    @if (isset($icon))
        {!! $icon !!}
    @endif
    {{ $text }}
</a>
