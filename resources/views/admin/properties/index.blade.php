<x-app-layout>
    <div class="flex justify-between text-center">
        <h1 class="text-2xl">
            {{ __('Tous les Biens') }}
        </h1>
        <a href="{{ route('admin.property.create') }}" class="button button-primary rounded-md">{{ __('New Bien') }}</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>{{ __('Title') }}</th>
                <th>{{ __('Surface') }}</th>
                <th>{{ __('Price') }}</th>
                <th>{{ __('City') }}</th>
                <th class="text-end">{{ __('Actions') }}</th>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($properties as $property)
                <tr>
                    <td>{{ $property->title }}</td>
                    <td>{{ $property->surface }}m²</td>
                    <td class="text-end">{{ number_format($property->price, thousands_separator: '.') }}</td>
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

</x-app-layout>
