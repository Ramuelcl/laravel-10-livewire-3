<div>
    <h1 class="text-2xl font-mono">Paises</h1>

    <div class="mb-4 inline-flex gap-2 mx-2">
        <x-secondary-button wire:click="$set('showForm', 0)">oculta formulario</x-secondary-button>
        <x-secondary-button wire:click="$toggle('showList')">muestra/oculta Lista</x-secondary-button>
    </div>
    <br>
    {{-- SIN formulario --}}
    <div class="mb-4 inline-flex gap-2 mx-2">
        <x-text-input type="text" wire:model='pais' placeholder="Agregar un país" />
        <x-primary-button wire:click="fncSave()">Agregar</x-primary-button>
    </div>

    {{-- formulario --}}
    @if ($showForm)
        <div>
            <form class="mb-4 inline-flex gap-2 mx-2" wire:submit="fncSave">
                <x-text-input type="text" wire:model='pais' placeholder="Agregar un país" />
                <x-primary-button wire:click="fncSave()">+</x-primary-button>
            </form>
        </div>
    @endif
    <div class="{{ $showList ? '' : 'hidden' }} my-6">
        <ul class="list-disc list-inside space-y-1">
            @foreach ($paises as $key => $pais)
                <div class="flex" wire:mouseenter="changeIs_Active('{{ $pais }}')">
                    <x-secondary-button wire:click="fncDelete({{ $key }})">-</x-secondary-button>
                    <li class="" wire:key="pais-{{ $key }}">{{ $pais }} </li>
                </div>
            @endforeach
        </ul>
    </div>
    {{ $is_active }}
</div>
