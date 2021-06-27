@extends('layout')

@section('page')
    <div class="flex justify-center">
        <div class="w-1/2 p-6">
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title">Title</label>
                    <input
                        name="title"
                        type="text"
                        placeholder="Title"
                        class="border-2 w-full p-4 rounded-lg"
                        value="{{ old('title') }}"
                    />
                    @error('title')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description">Description</label>
                    <textarea
                        name="description"
                        placeholder="Description"
                        class="border-2 w-full p-4 rounded-lg"
                    >{{ old('description') }}</textarea>
                    @error('description')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="price">Price</label>
                    <input
                        name="price"
                        type="number"
                        placeholder="Price"
                        class="border-2 w-full p-4 rounded-lg"
                        value="{{ old('price') }}"
                        step=".01"
                    />
                    @error('price')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 flex justify-between">
                    <label for="category_id">Category</label>
                    <select name="category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category['id'] }}">
                                {{ $category['name'] }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 flex justify-between">
                    <label for="show_phone_number">Show phone number</label>
                    <input
                        name="show_phone_number"
                        type="checkbox"
                        class="border-2 w-full p-4 rounded-lg"
                        checked="{{ old('show_phone_number') }}"
                    />
                </div>
                <div class="mb-3">
                    <div class="flex justify-between"><label for="expires_at">Expiration date</label>
                        <input
                            type="date"
                            name="expires_at"
                            value="{{ old('expires_at') }}"
                            min="{{ now()->format('Y-m-d') }}"
                            max="{{ now()->addDays(60)->format('Y-m-d') }}"
                            class="border-2 p-4 rounded-lg"
                        /></div>
                    @error('expires_at')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 flex justify-between">
                    <label for="images">Images</label>
                    <input
                        name="images[]"
                        type="file"
                        multiple
                        class="border-2 p-4 rounded-lg"
                    />
                    @error('images')
                        {{ $message }}
                    @enderror
                </div>
                <div class="mb-3 text-center">
                    <button type="submit" class="mb-3 text-center bg-green-500 p-3 w-full rounded-lg">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
