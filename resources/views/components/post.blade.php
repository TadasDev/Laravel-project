<div class="flex mb-6 justify-between">
    <div class="flex">
        <x-post.image :post="$post"/>
        <div class="ml-4">
            <div class="text-2xl">{{ $post->title }}</div>
            <div>{{ $post->description }}</div>
            <div>Created by: {{ $post->user->first_name }}</div>
            <div>Created at: {{ $post->user->created_at }}</div>
        </div>
    </div>
    <div class="flex-col ">
        <div title="{{ $post->created_at }}">{{ $post->created_at->diffForHumans() }}</div>

        @include('posts.stars.star')

        @can('delete', $post)
        <div>
            <form action="{{ route('posts.delete', $post) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 rounded-md p-1">Remove</button>
            </form>
        </div>
        @endcan
    </div>
</div>
