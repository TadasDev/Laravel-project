@extends('layout')

@section('page')
    <div class="flex justify-center">
        <div class="w-1/4 p-6">
            <form action="{{ route('authentication.registration') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="email">Email</label>
                    <input
                        name="email"
                        type="text"
                        placeholder="Your email"
                        class="border-2 w-full p-4 rounded-lg"
                        value="{{ old('email') }}"
                    />
                    @error('email')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="first_name">First name</label>
                    <input
                        name="first_name"
                        placeholder="First name"
                        type="text"
                        class="border-2 w-full p-4 rounded-lg"
                        value="{{ old('first_name') }}"
                    />
                    @error('first_name')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="last_name">Last name</label>
                    <input
                        name="last_name"
                        placeholder="Last name"
                        type="text"
                        class="border-2 w-full p-4 rounded-lg"
                        value="{{ old('last_name') }}"
                    />
                    @error('last_name')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="phone">Phone number</label>
                    <input
                        name="phone"
                        placeholder="Phone number"
                        type="text"
                        class="border-2 w-full p-4 rounded-lg"
                        value="{{ old('phone') }}"
                    />
                    @error('phone')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="city">City</label>
                    <input
                        name="city"
                        placeholder="City"
                        type="text"
                        class="border-2 w-full p-4 rounded-lg"
                        value="{{ old('city') }}"
                    />
                    @error('city')
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
                <div class="mb-3">
                    <label for="password_confirmation">Password confirmation</label>
                    <input
                        name="password_confirmation"
                        placeholder="Password confirmation"
                        type="text"
                        class="border-2 w-full p-4 rounded-lg"
                    />
                    @error('password_confirmation')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 text-center">
                    <button value="Register" type="submit" class="mb-3 text-center bg-green-500 p-3 w-full rounded-lg">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
