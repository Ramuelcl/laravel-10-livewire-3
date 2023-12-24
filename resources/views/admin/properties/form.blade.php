<x-app-layout>
    @if ($property->exists)
        {{ __('Editer un Bien') }}
    @else
        {{ __('Créer un Bien') }}
    @endif
    <form action="{{ route($property->exists ? 'admin.property.update' : 'admin.property.store', $property) }}"
        method="POST" class="flex flex-col gap-2">
        @csrf
        @method($property->exists ? 'PUT' : 'POST')
        <fieldset class="border-2 border-spacing-2 rounded-md p-4">
            <div class="grid grid-cols-3 gap-2">
                {{-- primera linea --}}
                <div class="col-span-2">
                    <x-tw_input name='title' label="Titre" value="{{ $property->title }}" align="left"
                        class="" />
                </div>
                <div class="flex gap-4">
                    <x-tw_input name='surface' label="Surface" value="{{ $property->surface }}" width="50" />

                    <x-tw_input name='price' label="Prix" value="{{ $property->price }}" width="50" />
                </div>

                {{-- segunda linea --}}
                <div class="col-span-3">
                    <x-tw_input name='description' label="Description" value="{{ $property->description }}"
                        type="textarea" align="left" />
                </div>
                {{-- tercera linea --}}
                <x-tw_input name='rooms' label="Pieces" value="{{ $property->rooms }}" align="left"
                    width="75" />
                <x-tw_input name='bedrooms' label="Chambres" value="{{ $property->bedrooms }}" align="left"
                    width="75" />
                <x-tw_input name='floor' label="Etages" value="{{ $property->floor }}" align="left"
                    width="75" />
                {{-- tercera linea --}}
                <div class="col-span-2">
                    <x-tw_input name='address' label="Address" value="{{ $property->address }}" />
                </div>
                <div class="inline-block gap-4 md:inline-flex">
                    <x-tw_input name='city' label="Ville" value="{{ $property->city }}" width="50" />
                    <x-tw_input name='postal_code' label="Postale Code" value="{{ $property->postal_code }}"
                        width="50" />
                </div>
            </div>
            <div class="grid grid-cols-2">
                <x-tw_select name='opttions' label="Options" multiple=true :array=$options class="mt-2" />
                <x-tw_checkbox name='sold' label="Vendu" value="{{ $property->sold }}" class="mt-2" />
            </div>
        </fieldset>
        <div>
            <x-tw_button bgColor="green"
                type="submit">{{ $property->exists ? __('Update') : __('Save') }}</x-tw_button>
        </div>
    </form>
</x-app-layout>
