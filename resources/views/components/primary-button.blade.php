@props([
    'disabled' => false,
    'color' => 'gray',
])
@php
    $colorFondo = "bg-$color-800";
    $colorTexto = "text-$color-100";
    $DarkcolorFondo = "dark:bg-$color-100";
    $DarkcolorTexto = "dark:text-$color-800";
    $cls =
        'inline-flex items-center px-4 py-2 ' .
        $colorFondo .
        ' ' .
        $colorTexto .
        ' border border-transparent rounded-md font-semibold text-xs ' .
        $DarkcolorFondo .
        ' dark:hover:bg-white dark:focus:bg-white dark:active:bg-gray-300 dark:focus:ring-offset-gray-800 ' .
        $DarkcolorTexto .
        ' tracking-widest hover:bg-gray-700 focus:bg-blue-700 active:bg-gray-900 focus:outline-none focus:ring-2
    focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150';
@endphp
{{-- @dump($colorFondo, $colorTexto) --}}
<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => $cls,
]) }} {{ $disabled ? 'disabled' : '' }}>
    {{ $slot }}
</button>
