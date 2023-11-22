<div class="container">
    @if (session('messages'))
        <div class="alert bg-green-300 text-center">{{ session('messages') }}</div>
    @endif
    {{-- @livewire('live-tabs', ['tabs' => $tabs, 'activeTab' => $activeTab]) --}}
    <div x-data="{ tab: window.location.hash ? window.location.hash : '#listado' }" x-init="tab = '#listado'">

        <!--Tabs navigation-->
        <div class="flex flex-row justify-center">

            <a class="px-4 border-b-2 border-gray-900 hover:border-teal-300  href="#listado"
                x-on:click.prevent="tab='#listado'"
                x-bind:class="{ 'text-teal-400 border-teal-300': tab === '#listado' }"">Listado</a>


            <a class="px-4 border-b-2 border-gray-900 hover:border-teal-300" href="#usuario"
                x-on:click.prevent="tab='#usuario'"
                x-bind:class="{ 'text-teal-400 border-teal-300': tab === '#usuario' }">Usuario</a>

            <a class="px-4 border-b-2 border-gray-900 hover:border-teal-300" href="#roles"
                x-on:click.prevent="tab='#roles'"x-bind:class="{ 'text-teal-400 border-teal-300': tab === '#roles' }">Roles</a>

            <a class="px-4 border-b-2 border-gray-900 hover:border-teal-300" href="#permisos"
                x-on:click.prevent="tab='#permisos'"x-bind:class="{ 'text-teal-400 border-teal-300': tab === '#permisos' }">Permisos</a>

        </div>

        <!--Tabs content-->
        <div x-show="tab == '#listado'" x-cloak>
            @livewire('backend.users.live-list')
        </div>

        <div x-show="tab == '#usuario'" x-cloak>
            @livewire('backend.users.live-forms')
        </div>

        <div x-show="tab == '#roles'" x-cloak>
            estoy en roles
            {{-- @livewire('backend.users.live-list') --}}
        </div>
        <div x-show="tab == '#permisos'" x-cloak>
            estoy en permisos
            {{-- @livewire('backend.users.live-list') --}}
        </div>
    </div>
</div>
