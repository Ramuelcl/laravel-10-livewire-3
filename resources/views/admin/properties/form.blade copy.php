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
        <fieldset>
            <div class="flex row">

                <x-tw_input name='titre' label="Titre" value="{{ $property->title }}" class="col" />
                <div class="flex col">
                    <x-tw_input name='surface' label="Surface" value="{{ $property->surface }}" class="col" / />
                    <x-tw_input name='price' value="{{ $property->price }}" class="col" />
                </div>
            </div>
            <x-tw_input name='description' label="Description" value="{{ $property->description }}" type="textarea" />
            <div class="row">
                <x-tw_input name='rooms' label="Pieces" value="{{ $property->rooms }}" class="col" />
                <x-tw_input name='bedrooms' label="Chambres" value="{{ $property->bedrooms }}" class="col" />
                <x-tw_input name='floor' label="Etages" value="{{ $property->floor }}" class="col" />
            </div>

            <div class="row">
                <x-tw_input name='address' value="{{ $property->address }}" class="col" />
                <x-tw_input name='city' label="Ville" value="{{ $property->city }}" class="col" />
                <x-tw_input name='postal_code' label="Postale Code" value="{{ $property->postal_code }}"
                    class="col" />
            </div>
            <x-tw_checkbox name='sold' label="Vendu" value="{{ $property->sold }}" class="col" />

        </fieldset>
    </form>
</x-app-layout>
