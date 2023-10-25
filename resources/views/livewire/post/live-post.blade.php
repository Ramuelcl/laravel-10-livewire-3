<div>
    <h1 class="font-extrabold">Hola desde el componente crear - editar - borrar {{ $titulo }}</h1>
    {{ $name }} - {{ $email }}<br>
    <div class="mb-4 inline-flex gap-2 mx-2">
        <x-text-input type="text" wire:model='name' />
        <x-primary-button wire:click="save()">Save</x-primary-button>
    </div>
</div>