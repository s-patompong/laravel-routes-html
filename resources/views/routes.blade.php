@extends('routes-html::layout')

@section('content')
    <div
        class="max-w-screen p-8"
        x-data="{
            routes: {{ json_encode($routes) }},
            filteredRoutes: [],
            filter: {
                domain: '',
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
                    this.sort.order = this.sort.order === 'asc' ? 'desc' : 'asc';
                } else {
                    this.sort.field = field;
                    this.sort.order = 'asc';
                }
            },
            onClickedRow(index) {
                this.selectedRoute = null;

                const route = this.filteredRoutes[index];

                if(!route.method.toLowerCase().includes('get')) {
                    return;
                }

                if(route.parameters.length === 0) {
                    let url = `/${_.trimStart(route.uri, '/')}`;

                    if(route.domain !== null) {
                        url = `${location.protocol}//${route.domain}${url}`;
                    }

                    window.open(url);

                    return;
                }

                this.$dispatch('selected-route', route);
            }
        }"
        x-effect="
            filteredRoutes = _.orderBy(
                routes.filter(route => {
                    const routeDomain = route.domain === null ? '' : route.domain;
                    const routeName = route.name === null ? '' : route.name;

                    let useRoute = route.uri.toLowerCase().includes(filter.uri.toLowerCase())
                        && route.method.toLowerCase().includes(filter.method.toLowerCase());

                    if((routeName !== null) && filter.name) {
                        useRoute = routeName.toLowerCase().includes(filter.name.toLowerCase());
                    }

                    if((routeDomain !== null) && filter.domain) {
                        useRoute = routeDomain.toLowerCase().includes(filter.domain.toLowerCase());
                    }

                    return useRoute;
                }),
                [sort.field],
                [sort.order]
            );
        "
        xmlns:x-routes-html="http://www.w3.org/1999/html">
        <h1 class="text-3xl">
            <span class="uppercase font-extrabold">Route List</span>
        </h1>

        <p class="text-gray-500 text-sm mb-4">HINT: Click on the GET route to open it.</p>

        <div class="mb-2 grid grid-cols-2 md:grid-cols-4 gap-2">
            @include('routes-html::components.input', ['model' => 'filter.domain', 'placeholder' => 'Domain', 'name' => 'domain'])
            @include('routes-html::components.input', ['model' => 'filter.method', 'placeholder' => 'Method', 'name' => 'method'])
            @include('routes-html::components.input', ['model' => 'filter.uri', 'placeholder' => 'URI', 'name' => 'uri'])
            @include('routes-html::components.input', ['model' => 'filter.name', 'placeholder' => 'Name', 'name' => 'name'])
        </div>

        <div class="shadow overflow-x-scroll border-b border-gray-200 rounded-lg">
            <table class="min-w-full divide-y divide-gray-200" x-cloak>
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
                <template x-for="(route, index) in filteredRoutes">
                    <tr
                        class="hover:bg-gray-100"
                        :class="{
                            'cursor-pointer': route.method.toLowerCase().includes('get'),
                            'cursor-not-allowed': !route.method.toLowerCase().includes('get')
                        }"
                        @click="onClickedRow(index)"
                    >
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
