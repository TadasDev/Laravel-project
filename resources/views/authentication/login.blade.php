@extends('layout')

@section('page')
    <div class="flex justify-center">
        <div class="w-1/4 p-6">
            <form action="{{ route('authentication.login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input name="email" type="text" placeholder="Your email" class="border-2 w-full p-4 rounded-lg"/>
                    @error('email')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password">Password</label>
                    <input name="password" placeholder="Password" type="text" class="border-2 w-full p-4 rounded-lg"/>
                    @error('password')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 text-center">
                    <button type="submit" class="mb-3 text-center bg-green-500 p-3 w-full rounded-lg">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
