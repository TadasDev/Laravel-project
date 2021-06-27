<?php
/* @var App\Models\Post $post */
/* @var \Illuminate\Support\Collection $posts */
?>

@if ($posts->count() > 0)
    @foreach ($posts as $post)
        <x-post :post="$post" />
    @endforeach
    {{ $posts->withQueryString()->links() }}
@else
    No posts yet
@endif
