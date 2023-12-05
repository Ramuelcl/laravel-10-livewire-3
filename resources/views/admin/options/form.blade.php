<x-app-layout>
    @if ($option->exists)
        {{ __('Editer une Option') }}
    @else
        {{ __('Créer une Option') }}
    @endif
    <form action="{{ route($option->exists ? 'admin.option.update' : 'admin.option.store', $option) }}" method="POST"
        class="flex flex-col gap-2">
        @csrf
        @method($option->exists ? 'PUT' : 'POST')
        <fieldset class="border-2 border-spacing-2 rounded-md p-4">
            <div class="columns-2 align-top items-center">
                <x-tw_input name='name' label="Nom" value="{{ $option->name }}" align="left" />
                {{-- <x-tw_checkbox name='checkit' label="Si" value="{{ $option->checkit }}" class="mt-2" /> --}}
            </div>
        </fieldset>
        <div>
            <x-tw_button text="{{ $option->exists ? __('Update') : __('Save') }}" bgColor="green" />
        </div>
    </form>
</x-app-layout>
