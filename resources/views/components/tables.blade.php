<!-- views/components/tables.blade.php -->

@props(['datas', 'td', 'onSearch' => true, 'onActive' => true])
{{-- @dd($td); --}}
<div class="overflow-x-auto bg-white dark:bg-neutral-700 h-[150px] overflow-y-scroll">

    <!-- Search input -->
    @if ($onSearch)
        <div class="relative m-[2px] mb-3 mr-5 float-left">
            @livewire('live-search')
        </div>
    @endif
    @if ($onActive)
        <!-- Filter is_active -->
        <div class="relative m-[2px] mb-3 float-right hidden sm:block">
            @livewire('live-active')
        </div>
    @endif

    <!-- Table -->
    <table class="min-w-full text-left text-xs whitespace-nowrap">

        <!-- Table head -->
        <thead
            class="uppercase tracking-wider sticky top-0 outline outline-2 outline-neutral-200 dark:outline-neutral-600 bg-neutral-50 dark:bg-neutral-800 border-t">
            <tr>
                <th scope="col" class="px-6 py-2 border-x dark:border-neutral-600">
                    Product
                    <a href="" class="inline">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"
                            class="w-[0.65rem] h-[0.65rem] inline ml-1 text-neutral-500 dark:text-neutral-200 mb-[1px]"
                            fill="currentColor">
                            {/* Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License -
                            https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. */}
                            <path
                                d="M137.4 41.4c12.5-12.5 32.8-12.5 45.3 0l128 128c9.2 9.2 11.9 22.9 6.9 34.9s-16.6 19.8-29.6 19.8H32c-12.9 0-24.6-7.8-29.6-19.8s-2.2-25.7 6.9-34.9l128-128zm0 429.3l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128c-12.5 12.5-32.8 12.5-45.3 0z" />
                        </svg>
                    </a>

                </th>
                <th scope="col" class="px-6 py-2 border-x dark:border-neutral-600">
                    Price
                    <a href="" class="inline">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"
                            class="w-[0.65rem] h-[0.65rem] inline ml-1 text-neutral-500 dark:text-neutral-200 mb-[1px]"
                            fill="currentColor">
                            {/* Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License -
                            https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. */}
                            <path
                                d="M137.4 41.4c12.5-12.5 32.8-12.5 45.3 0l128 128c9.2 9.2 11.9 22.9 6.9 34.9s-16.6 19.8-29.6 19.8H32c-12.9 0-24.6-7.8-29.6-19.8s-2.2-25.7 6.9-34.9l128-128zm0 429.3l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128c-12.5 12.5-32.8 12.5-45.3 0z" />
                        </svg>
                    </a>

                </th>
                <th scope="col" class="px-6 py-2 border-x dark:border-neutral-600">
                    Stock
                    <a href="" class="inline">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"
                            class="w-[0.65rem] h-[0.65rem] inline ml-1 text-neutral-500 dark:text-neutral-200 mb-[1px]"
                            fill="currentColor">
                            {/* Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License -
                            https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. */}
                            <path
                                d="M137.4 41.4c12.5-12.5 32.8-12.5 45.3 0l128 128c9.2 9.2 11.9 22.9 6.9 34.9s-16.6 19.8-29.6 19.8H32c-12.9 0-24.6-7.8-29.6-19.8s-2.2-25.7 6.9-34.9l128-128zm0 429.3l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128c-12.5 12.5-32.8 12.5-45.3 0z" />
                        </svg>
                    </a>

                </th>
                <th scope="col" class="px-6 py-2 border-x dark:border-neutral-600">
                    Status
                    <a href="" class="inline">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"
                            class="w-[0.65rem] h-[0.65rem] inline ml-1 text-neutral-500 dark:text-neutral-200 mb-[1px]"
                            fill="currentColor">
                            {/* Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License -
                            https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. */}
                            <path
                                d="M137.4 41.4c12.5-12.5 32.8-12.5 45.3 0l128 128c9.2 9.2 11.9 22.9 6.9 34.9s-16.6 19.8-29.6 19.8H32c-12.9 0-24.6-7.8-29.6-19.8s-2.2-25.7 6.9-34.9l128-128zm0 429.3l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128c-12.5 12.5-32.8 12.5-45.3 0z" />
                        </svg>
                    </a>

                </th>
            </tr>
        </thead>

        <!-- Table body -->
        <tbody>

            <tr class="border-b dark:border-neutral-600 hover:bg-neutral-100 dark:hover:bg-neutral-600">
                <th scope="row" class="px-6 py-2 border-x dark:border-neutral-600">
                    Handbag
                </th>
                <td class="px-6 py-2 border-x dark:border-neutral-600">$129.99</td>
                <td class="px-6 py-2 border-x dark:border-neutral-600">30</td>
                <td class="px-6 py-2 border-x dark:border-neutral-600">In Stock</td>
            </tr>

            <tr
                class="border-b dark:border-neutral-600 hover:bg-neutral-100 dark:hover:bg-neutral-600 bg-neutral-50 dark:bg-neutral-800">
                <th scope="row" class="px-6 py-2 border-x dark:border-neutral-600">
                    Shoes
                </th>
                <td class="px-6 py-2 border-x dark:border-neutral-600">$89.50</td>
                <td class="px-6 py-2 border-x dark:border-neutral-600">25</td>
                <td class="px-6 py-2 border-x dark:border-neutral-600">In Stock</td>
            </tr>

            <tr class="border-b dark:border-neutral-600 hover:bg-neutral-100 dark:hover:bg-neutral-600">
                <th scope="row" class="px-6 py-2 border-x dark:border-neutral-600">
                    Bedding Set
                </th>
                <td class="px-6 py-2 border-x dark:border-neutral-600">$69.99</td>
                <td class="px-6 py-2 border-x dark:border-neutral-600">40</td>
                <td class="px-6 py-2 border-x dark:border-neutral-600">In Stock</td>
            </tr>

            <tr
                class="border-b dark:border-neutral-600 hover:bg-neutral-100 dark:hover:bg-neutral-600 bg-neutral-50 dark:bg-neutral-800">
                <th scope="row" class="px-6 py-2 border-x dark:border-neutral-600">
                    Dining Table
                </th>
                <td class="px-6 py-2 border-x dark:border-neutral-600">$449.99</td>
                <td class="px-6 py-2 border-x dark:border-neutral-600">5</td>
                <td class="px-6 py-2 border-x dark:border-neutral-600">In Stock</td>
            </tr>

            <tr class="border-b dark:border-neutral-600 hover:bg-neutral-100 dark:hover:bg-neutral-600">
                <th scope="row" class="px-6 py-2 border-x dark:border-neutral-600">
                    Soap Set
                </th>
                <td class="px-6 py-2 border-x dark:border-neutral-600">$24.95</td>
                <td class="px-6 py-2 border-x dark:border-neutral-600">50</td>
                <td class="px-6 py-2 border-x dark:border-neutral-600">In Stock</td>
            </tr>

        </tbody>

        <!-- Table footer -->
        <tfoot class="border-t-2 dark:border-neutral-600">
            <tr>
                {{ $datas->links }}
            </tr>
        </tfoot>

    </table>

</div>
