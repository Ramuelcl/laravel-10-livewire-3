@error($field)
<div {{ $attributes->merge(['class' => 'text-sm text-red-500 dark:text-red-400 space-y-1 text-sm mt-2']) }}>
    {{ $message }}
</div>
@enderror