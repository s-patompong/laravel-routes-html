@extends('routes-html::layout')

@section('content')
    <div class="max-w-screen p-8">
        <h1 class="text-3xl mb-4">
            <span class="border-2 border-green-600 py-1 px-4">Route List</span>
        </h1>

        <div class="overflow-x-scroll">
            <table class="table-auto border-collapse">
                <thead>
                <tr>
                    <th class="text-left border-b border-green-600 py-1 px-3">Domain</th>
                    <th class="text-left border-b border-green-600 py-1 px-3">Method</th>
                    <th class="text-left border-b border-green-600 py-1 px-3">URI</th>
                    <th class="text-left border-b border-green-600 py-1 px-3">Name</th>
                    <th class="text-left border-b border-green-600 py-1 px-3">Action</th>
                    <th class="text-left border-b border-green-600 py-1 px-3">Middleware</th>
                </tr>
                </thead>
                <tbody>
                @foreach($routes as $route)
                    <tr>
                        <td class="border-b border-green-600 py-1 px-3">{{ $route['domain'] ?? '-' }}</td>
                        <td class="border-b border-green-600 py-1 px-3">{{ $route['method'] }}</td>
                        <td class="border-b border-green-600 py-1 px-3">{{ $route['uri'] }}</td>
                        <td class="border-b border-green-600 py-1 px-3">{{ $route['name'] }}</td>
                        <td class="border-b border-green-600 py-1 px-3">{{ $route['action'] }}</td>
                        <td class="border-b border-green-600 py-1 px-3">{{ $route['middleware'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
