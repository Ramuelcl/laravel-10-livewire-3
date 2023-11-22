<div>
    <ul class="flex border-b">
        @foreach ($tabs as $index => $tab)
            <li class="-mb-px mr-1">
                <a class="bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold"
                    href="#{{ $tab['sufix'] }}"
                    wire:click.prevent="setActiveTab({{ $index }})">{{ $tab['title'] }}</a>
            </li>
        @endforeach
    </ul>

    <div class="py-4">
        @foreach ($tabs as $index => $tab)
            @if ($activeTab === $index)
                @livewire('backend.users.' . $tab['component'])
            @endif
        @endforeach
    </div>

    @livewireScripts
</div>
