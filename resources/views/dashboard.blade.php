<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-2 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                {{-- @livewire('post.live-post')
                @livewire('post.live-post', ['titulo' => 'Posteos', 'user' => 1])
                Fuera del componente --}}

                @livewire('post.live-formulario')

            </div>
        </div>
    </div>
</x-app-layout>
