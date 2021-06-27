@extends('layout')

@section('page')
    <div class="flex justify-center text-4xl">My posts</div>
    <div class="flex justify-between mb-6">
        <a href="{{ route('posts.create') }}" class="p-2 rounded-md bg-green-500">Create post</a>
        <form action="{{ route('dashboard') }}" method="GET">
            <select name="status">
                <option
                    value="active"
                    {{ app('request')->input('status') === 'active' ? 'selected' : ''}}
                >
                    Active
                </option>
                <option
                    value="inactive"
                    {{ app('request')->input('status') === 'inactive' ? 'selected' : ''}}
                >
                    Inactive
                </option>
                <option
                    value="closed"
                    {{ app('request')->input('status') === 'closed' ? 'selected' : ''}}
                >
                    Closed
                </option>
            </select>
            <button class="rounded-md bg-green-500 p-2">Filter</button>
        </form>
    </div>
    <div class="flex justify-between flex-col">
        @include('posts.list')
    </div>
@endsection
