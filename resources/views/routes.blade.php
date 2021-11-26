@extends('routes-html::layout')

@section('content')
    <div
        class="max-w-screen p-8"
        x-data="{
            routes: {{ json_encode($routes) }},
            filteredRoutes: [],
            filter: {
                uri: '',
                name: ''
            },
            sort: {
                field: 'uri',
                order: 'asc'
            },
            onClickedHeader(field) {
                if(field === this.sort.field) {
                    this.toggleSortOrder();
                } else {
                    this.sort.field = field;
                    this.sort.order = 'asc';
                }
            },
            toggleSortOrder() {
                this.sort.order = this.sort.order === 'asc' ? 'desc' : 'asc';
            }
        }"
        x-effect="
            filteredRoutes = _.orderBy(
                routes.filter(route => route.uri.includes(filter.uri) && route.name?.includes(filter.name)),
                [sort.field],
                [sort.order]
            );
        "
    >
        <h1 class="text-3xl mb-4">
            <span class="uppercase font-extrabold">Route List</span>
        </h1>

        <div class="mb-2 flex gap-2">
            <input
                type="text"
                x-model="filter.uri"
                placeholder="URI"
                class="rounded-md px-2 py-1 w-64 shadow focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50 focus:outline-none border border-transparent focus:border-blue-600"
            >
            <input
                type="text"
                x-model="filter.name"
                placeholder="Name"
                class="rounded-md px-2 py-1 w-64 shadow focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50 focus:outline-none border border-transparent focus:border-blue-600"
            >
        </div>

        <div class="shadow overflow-x-scroll border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    @include('routes-html::components.table-header', ['field' => 'domain', 'title' => 'Domain'])
                    @include('routes-html::components.table-header', ['field' => 'method', 'title' => 'Method'])
                    @include('routes-html::components.table-header', ['field' => 'uri', 'title' => 'URI'])
                    @include('routes-html::components.table-header', ['field' => 'name', 'title' => 'Name'])
                    @include('routes-html::components.table-header', ['field' => 'action', 'title' => 'Action'])
                    @include('routes-html::components.table-header', ['field' => 'middleware', 'title' => 'Middleware'])
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 text-sm">
                <template x-for="route in filteredRoutes">
                    <tr>
                        <td class="px-6 py-2 whitespace-nowrap" x-text="route.domain || '-'"></td>
                        <td class="px-6 py-2 whitespace-nowrap" x-text="route.method"></td>
                        <td class="px-6 py-2 whitespace-nowrap" x-text="route.uri"></td>
                        <td class="px-6 py-2 whitespace-nowrap" x-text="route.name || '-'"></td>
                        <td class="px-6 py-2 whitespace-nowrap" x-text="route.action"></td>
                        <td class="px-6 py-2 whitespace-nowrap" x-html="route.middleware"></td>
                    </tr>
                </template>
                </tbody>
            </table>
        </div>
    </div>
@endsection
