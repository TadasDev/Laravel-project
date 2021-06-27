@if ($post->images()->count() > 0)
    <img
        src="{{ asset('storage/' . $post->images()->first()->file_path) }}"
        title="Post image"
        width="180"
        height="180"
    />
@else
    <img src="http://suninjuly.github.io/images/bullet_cat.jpg" title="Post image" width="180" height="180">
@endif
