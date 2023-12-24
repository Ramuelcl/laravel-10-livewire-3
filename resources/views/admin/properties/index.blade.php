<x-app-layout>
    <div class="flex justify-between text-center">
        <h1 class="text-2xl">
            {{ __('Tous les Biens') }}
        </h1>
        <x-tw_button_a route="admin.property.create" text="{{ __('New Bien') }}" bgColor="blue" />
    </div>
    <div class="">
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th>{{ __('Id') }}</th>
                    <th class="text-start pl-2">{{ __('Title') }}</th>
                    <th>{{ __('Surface') }}</th>
                    <th>{{ __('Price') }}</th>
                    <th>{{ __('City') }}</th>
                    <th>{{ __('Vendu') }}</th>
                    <th class="text-end">{{ __('Actions') }}</th>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($properties as $property)
                    <tr class="even:bg-gray-100 odd:bg-white">
                        <td class="text-end pr-2">{{ $property->id }}</td>
                        <td>{{ $property->title }}</td>
                        <td class="text-end pr-2">{{ $property->surface }}m²</td>
                        <td class="text-end pr-4">{{ number_format($property->price, 0, ',', '.') }}€</td>
                        <td>{{ $property->city }}</td>
                        <td class="text-center">{{ $property->sold == 1 ? 'Oui' : 'Non' }}</td>
                        <td class="w-100 text-end">
                            <div class="inline-flex gap-2 ">
                                <a href="{{ route('admin.property.edit', $property) }}"
                                    class="inline-flex items-center justify-center min-w-200  bg-green-500 hover:bg-green-600 active:bg-green-700 focus:outline-none focus:ring focus:ring-green-300 text-gray-100 rounded-md p-2">{{ __(' Edit ') }}</a>
                                <form action="{{ route('admin.property.destroy', $property) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <x-tw_button bgColor="red" type="submit">{{ __('Delete') }}</x-tw_button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $properties->links() }}
    </div>
</x-app-layout>
