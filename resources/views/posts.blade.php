@extends('layout')

@section('page')
    <div class="flex justify-center text-4xl">All posts</div>
    <div class="flex justify-between flex-col">
        @include('posts.list')
    </div>
@endsection
