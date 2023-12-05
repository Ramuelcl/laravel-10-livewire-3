@props(['name' => null, 'class' => ''])

<div>
    @if (!$name)
        <div class="text-red-500">El nombre es nulo para el error.</div>
    @else
        @error($name)
            <div @class(['text-2xs text-red-900', $class])>
                {{ $message }}
            </div>
        @enderror
    @endif
</div>
