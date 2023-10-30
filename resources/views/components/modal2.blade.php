@if ($show)
<div name="modal" class="bg-gray-800 bg-opacity-25 fixed inset-0">
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white border-blue-500 shadow rounded-lg p-6">
                {{ $slot ?? '' }}
            </div>
        </div>
    </div>
</div>
@endif