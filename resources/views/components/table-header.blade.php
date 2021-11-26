<th
    scope="col"
    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
>
    <div
        class="flex gap-1 items-center cursor-pointer select-none"
        @click="onClickedHeader('{{ $field }}')"
    >

        {{--Field Name--}}
        <span>{{ $title }}</span>

        {{--Sort Icon--}}
        <div x-show="sort.field === '{{ $field }}'">

            {{--Chevron Down Icon--}}
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4"
                fill="none"
                viewBox="0 0 24 24"
                x-show="sort.order === 'asc'"
                stroke="currentColor">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M19 9l-7 7-7-7"
                />
            </svg>

            {{--Chevron Up Icon--}}
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4"
                fill="none"
                viewBox="0 0 24 24"
                x-show="sort.order === 'desc'"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M5 15l7-7 7 7"
                />
            </svg>

        </div>

    </div>
</th>
