<div class="relative m-[2px] float-left w-1/3">
    <label for="search" class="sr-only">Search </label>
    {{-- {{ $search }} --}}
    <x-input wire:model.live="search" id="search" type="search" placeholder="Search..." icon="search" class="block w-64 rounded-lg border dark:border-none dark:bg-neutral-600 py-2 px-6 pr-4 text-sm focus:border-blue-400 focus:outline-none focus:ring-1 focus:ring-blue-400" />
</div>