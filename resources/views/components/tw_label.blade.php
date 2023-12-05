@props(['name' => null, 'label' => '', 'class' => ''])

@if (!$name)
    <div class="text-red-500">El nombre es nulo para el tw_label.</div>
@else
    <div @class(['form-group', $class])>
        <label for="{{ $name }}" class="text-slate-400 font-semibold">{{ __($label ? $label : '') }}</label>
    </div>
@endif
