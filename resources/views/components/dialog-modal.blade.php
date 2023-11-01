@props(['id' => null, 'maxWidth' => null])

<x-modal2 :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4">
        <div class="flex-row justify-between text-lg border-b-4 bg-gray-100">
            {{ $title ?? null }}
            <div>X</div>
        </div>

        <div class="mt-4">
            {{ $content }}
        </div>
    </div>

    <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right border-t-4">
        {{ $footer ?? null }}
    </div>
</x-modal2>