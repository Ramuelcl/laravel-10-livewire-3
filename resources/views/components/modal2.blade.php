@if ($show)
<div name="modal" class="bg-gray-800 bg-opacity-25 fixed inset-0">
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white border-blue-500 shadow rounded-lg p-6">
                <div class="flex-row justify-between text-lg border-b-4 bg-gray-100">
                    {{ $title ?? null }}
                    <div>X</div>
                </div>

                <div class="mt-4">
                    {{ $content }}
                </div>
            </div>

            <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right border-t-4">
                {{ $footer ?? null }}
            </div>
        </div>
    </div>
</div>
@endif