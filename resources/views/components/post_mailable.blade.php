<tr class="flex mb-6 justify-between">
    <div class="flex">
        <div class="ml-4">
            <div class="text-2xl">{{ $post->title }}</div>
            <div>{{ $post->description }}</div>
        </div>
    </div>
    <div class="flex-col ">
        <div title="{{ $post->created_at }}">{{ $post->created_at->diffForHumans() }}</div>
    </div>
</tr>
