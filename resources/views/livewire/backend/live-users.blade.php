<div class="container">
    @if (session('messages'))
        <div class="alert bg-green-300 text-center">{{ session('messages') }}</div>
    @endif
    <div class="row">
        <!-- Table responsive wrapper -->
        <div class="col-6">
            @livewire('backend.live-list-users')
        </div>
        <!-- formulario -->
        <div class="col-6">
            <form wire:submit="fncGuardar()">
                <x-button primary type="submit" wire:click="fncGuardar()">Guardar</x-button>
                <div wire:loading.attr="disabled" wire:target="fncGuardar" class="text-cyan-600">Guardando datos
                </div>
                <fieldset {{ false ? 'disabled' : '' }}>
                    <div class="p-2">
                        <x-input name="name" wire:model="name" placeholder="Nombre de usuario" icon="user" />
                    </div>
                    <div class="p-2">
                        <x-input name="email" wire:model="email" placeholder="eMail" icon="mail" />
                    </div>
                    <div class="p-2">
                        <x-inputs.password name="password" wire:model="password" placeholder="Contraseña"
                            icon="key" />
                    </div>
                    <!--Default checkbox-->
                    <div class="pl-8 mb-[0.125rem] block min-h-[1.5rem]">
                        <label class="text-gray-400 inline-block pl-[0.15rem] hover:cursor-pointer" for="is_active">
                            Activo
                        </label>
                        <input type="checkbox" id="is_active" wire:model="is_active" />
                        <x-input-errors field="is_active" />
                    </div>
                    {{-- <x-input-file label="uno" wire:model="profile_photo_path" /> --}}
                    <div class="mb-3 flex-">
                        <div>
                            <input accept="image/png, image/jpeg, image/jpg"
                                class="m-0 block w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary"
                                type="file" id="formFile" wire:model="profile_photo_path" />
                            <div wire:loading wire:target="profile_photo_path">
                                <div class="border-cyan-600 inline-block h-4 w-4 animate-spin rounded-full border-4  border-solid border-current border-r-transparent align-[-0.125em] text-info motion-reduce:animate-[spin_1.5s_linear_infinite]"
                                    role="status">
                                    <span
                                        class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span>
                                </div>
                            </div>
                            <x-input-errors field="profile_photo_path" />
                        </div>
                        @if ($profile_photo_path)
                            <div>
                                <img src="{{ $profile_photo_path->temporaryUrl() }}" class="w-2/12 text-center">
                            </div>
                        @endif
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
