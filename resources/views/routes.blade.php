@extends('routes-html::layout')

@section('content')
    <div
        class="max-w-screen p-8"
        x-data="{
            routes: {{ json_encode($routes) }},
            filteredRoutes: [],
            filter: {
                method: '',
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
                routes.filter(route => {
                    return route.uri.toLowerCase().includes(filter.uri.toLowerCase())
                        && route.name?.toLowerCase().includes(filter.name.toLowerCase())
                        && route.method.toLowerCase().includes(filter.method.toLowerCase());
                }),
                [sort.field],
                [sort.order]
            );
        "
    >
        <h1 class="text-3xl mb-4">
            <span class="uppercase font-extrabold">Route List</span>
        </h1>

        <div class="mb-2 flex flex-col md:flex-row gap-2">
            @include('routes-html::components.filter-input', ['model' => 'filter.method', 'placeholder' => 'Method'])
            @include('routes-html::components.filter-input', ['model' => 'filter.uri', 'placeholder' => 'URI'])
            @include('routes-html::components.filter-input', ['model' => 'filter.name', 'placeholder' => 'Name'])
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
                <tr x-show="filteredRoutes.length === 0">
                    <td colspan="6" class="px-6 py-2 whitespace-nowrap">Route not found.</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
