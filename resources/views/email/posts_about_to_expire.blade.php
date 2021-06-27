Dear, {{ $user->first_name }}

Here are the posts that will expire tomorrow:
@foreach($posts as $post)

    <x-post_mailable :post="$post" />
@endforeach
