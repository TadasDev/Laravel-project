<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <title>Adsy</title>
</head>
<body class="bg-blue-50">
    <nav class="flex p-6 justify-between bg-blue-100">
        <ul class="flex items-center">
            <li class="p-4">
                <a href="{{ route('home') }}">Home</a>
            </li>
            @auth
            <li class="p-4">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            @endauth
            @auth
                <li class="p-4">
                    <a href="{{ route('notification.preferences') }}">Notification preferences</a>
                </li>
            @endauth
            <li class="p-4">
                <a href="{{ route('posts.list') }}">Posts</a>
            </li>
        </ul>
        <ul class="flex items-center">
            @auth
            <li class="p-4">
                <a href="">Hello, {{ auth()->user()['first_name'] }}</a>
            </li>
            <li class="p-4">
                <form action="{{ route('authentication.logout') }}" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </li>
                <li class="p-4">
                    <a href="{{ route('profile.edit') }}">My profile</a>
                </li>
            @endauth
            @guest
            <li class="p-4">
                <a href="{{ route('authentication.registration') }}">Register</a>
            </li>
            <li class="p-4">
                <a href="{{ route('authentication.login') }}">Login</a>
            </li>
            @endguest
        </ul>
    </nav>
    <div class="sm:container sm:mx-auto xl:p-6 xl:pl-36 xl:pr-36">@yield('page')</div>
</body>
</html>
