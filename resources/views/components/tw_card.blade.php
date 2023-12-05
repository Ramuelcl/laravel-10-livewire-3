<div class="max-w-sm w-full lg:max-w-full lg:flex">
    <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden"
        style="background-image: url('/img/card-left.jpg')" title="Woman holding a mug">
    </div>
    <div class="w-max rounded-md border-2 border-blue-500 bg-blue-100 p-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-blue-700 font-bold text-lg">{{ $title ?? null }}</h2>
            @if ($showCloseButton)
                <button class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">X</button>
            @endif
        </div>
        <div class="border-t-2 border-b-2 border-blue-500 py-4">
            {{ $slot }}
        </div>
        <div class="flex justify-between items-center mt-4">
            @if ($showCancelButton)
                <button class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">{{ __($textCancel) }}</button>
            @endif
            @if ($showChangeButton)
                <button
                    class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">{{ __($textChange) }}</button>
            @endif
        </div>
    </div>
</div>
