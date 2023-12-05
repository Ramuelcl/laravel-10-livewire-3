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
            <div class="columns-2 align-top items-center">
                <x-tw_input name='title' label="Titre" value="{{ $property->title }}" align="left" />
                <div class="columns-2 gap-2">
                    <x-tw_input name='surface' label="Surface" value="{{ $property->surface }}" />
                    <x-tw_input name='price' label="Prix" value="{{ $property->price }}" />
                </div>
            </div>
            <x-tw_input name='description' label="Description" value="{{ $property->description }}" type="textarea"
                width="w-full" align="left" />

            <div class="columns-3 items-center">
                <x-tw_input name='rooms' label="Pieces" value="{{ $property->rooms }}" />
                <x-tw_input name='bedrooms' label="Chambres" value="{{ $property->bedrooms }}" />
                <x-tw_input name='floor' label="Etages" value="{{ $property->floor }}" />
            </div>

            <div class="columns-3 items-center">
                <x-tw_input name='address' label="Address" value="{{ $property->address }}" />
                <x-tw_input name='city' label="Ville" value="{{ $property->city }}" />
                <x-tw_input name='postal_code' label="Postale Code" value="{{ $property->postal_code }}" />
            </div>
            <x-tw_checkbox name='sold' label="Vendu" value="{{ $property->sold }}" class="mt-2" />
        </fieldset>
        <div>
            <x-tw_button text="{{ $property->exists ? __('Update') : __('Save') }}" bgColor="green" />
        </div>
    </form>
</x-app-layout>
