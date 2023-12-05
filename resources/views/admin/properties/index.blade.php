<x-app-layout>
    <div class="flex justify-between text-center">
        <h1 class="text-2xl">
            {{ __('Tous les Biens') }}
        </h1>
        <a href="{{ route('admin.property.create') }}" class="button button-primary rounded-md">{{ __('New Bien') }}</a>
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
                        <td class="text-end">
                            <div class="inline-flex gap-2 w-100 justify-items-end">
                                <a href="{{ route('admin.property.edit', $property) }}"
                                    class="btn-secondary rounded-md">{{ __('Edit') }}</a>
                                <form action="{{ route('admin.property.destroy', $property) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-danger rounded-md">{{ __('Delete') }}</button>
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
