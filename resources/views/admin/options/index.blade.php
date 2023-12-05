<x-app-layout>
    <div class="flex justify-between text-center">
        <h1 class="text-2xl">
            {{ __('Toutes les Options') }}
        </h1>
        <x-tw_button_a route="admin.option.create" text="{{ __('New Option') }}" bgColor="blue" />
    </div>
    <div class="">
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th>{{ __('Id') }}</th>
                    <th class="text-start pl-2">{{ __('Nom') }}</th>
                    <th class="text-end">{{ __('Actions') }}</th>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($options as $option)
                    <tr class="even:bg-gray-100 odd:bg-white">
                        <td class="text-end pr-2">{{ $option->id }}</td>
                        <td>{{ $option->name }}</td>
                        <td class="w-100 text-end">
                            <div class="inline-flex gap-2 ">
                                <a href="{{ route('admin.option.edit', $option) }}"
                                    class="inline-flex items-center justify-center min-w-200  bg-green-500 hover:bg-green-600 active:bg-green-700 focus:outline-none focus:ring focus:ring-green-300 text-gray-100 rounded-md p-2">{{ __(' Edit ') }}</a>
                                <form action="{{ route('admin.option.destroy', $option) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <x-tw_button bgColor="red" text="{{ __('Delete') }}" />

                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $options->links() }}
    </div>
</x-app-layout>
