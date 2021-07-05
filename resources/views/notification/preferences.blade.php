@extends('layout')

@section('page')
    <div class="flex justify-center">
        <div class="w-1/2 p-6">
            <form action="{{ route('notification.preferences') }}" method="POST">
                @csrf
                @auth
                <div class="mb-3">
                    <label for="notification">Subscribe to categories</label>
                    @error('category_ids')
                    <div class="text-red-500 ">{{ $message }}</div>
                    @enderror
                    <select name="category_ids[]" multiple class="w-full border bg-white rounded px-3 py-2 outline-none text-gray-700">
                        @foreach($categories as $category)
                            <option value="{{ $category['id'] }}">
                                {{ $category['name'] }}
                            </option>
                        @endforeach
                    </select>
                    <div class="mb-3 text-center">
                        <button type="submit" class="mb-3 text-center bg-green-500 p-3 w-full rounded-lg">Submit</button>
                    </div>
              </div>
                @endauth
            </form>
        </div>
    </div>
@endsection

