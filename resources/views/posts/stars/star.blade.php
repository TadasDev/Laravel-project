<div>
    @can('star', $post)
        <form action="{{ route('posts.stars', $post) }}" method="POST">
            @csrf
            <button class="bg-green-500 rounded-md p-1" type="submit">Add star</button>
        </form>
    @endcan
    @can('unstar', $post)
        <form action="{{ route('posts.stars', $post) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="bg-red-500 rounded-md p-1" type="submit">Remove star</button>
        </form>
    @endcan()
</div>
