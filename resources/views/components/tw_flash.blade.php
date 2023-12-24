<!-- resources/views/components/tw_flash.blade.php -->
@php
    $types = ['success', 'info', 'warning', 'danger'];
@endphp

@foreach ($types as $type)
    @if (Session::has($type))
        <x-tw_alert type="{{ $type }}">
            @php
                $mensajes = Session::get($type);
            @endphp

            @if (is_array($mensajes))
                @foreach ($mensajes as $mensaje)
                    {{ $mensaje }}<br>
                @endforeach
            @else
                {{ $mensajes }}
            @endif
        </x-tw_alert>
        @php
            $mensajes = Session::forget($type);
        @endphp
    @endif
@endforeach
