<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        @livewireStyles
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    </head>
    <body class="antialiased bg-gray-500">
        <div class="absolute top-0 h-14 w-full bg-white z-10 px-8 flex justify-center space-y-9 ">
            <ul class="flex space-x-12 my-auto font-semibold text-xl justify-between">
                <li>
                    <a href="{{route('pc-builder')}}">PC BUILDER</a>
                </li>
                <li>
                    <a href="{{route('browse-components')}}">BROWSE COMPONENTS</a>
                </li>
                <li>
                    <a href="{{route('browse-brands')}}">BROWSE BRANDS</a>
                </li>
                <li>
                    <a href="{{route('browse-categories')}}">BROWSE CATEGORIES</a>
                </li>
                <li>
                    <a href="{{route('pc-builder-guide')}}">PC BUILDER GUIDE</a>
                </li>
                <li>
                    <a href="{{route('terms.show')}}">TNC</a>
                </li>
                <li>
                    <a href="{{route('policy.show')}}">PRIVACY</a>
                </li>
                <li>
                    <a href="{{route('about-us')}}">ABOUT</a>
                </li>
            </ul>
        </div>
        <div class="text-white text-center font-semibold text-xl pt-14 my-1"><h1>These are the components that are essential for building your custom PC! Here are all the categories showing our number of parts that are available for viewing!</h1></div>
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block z-20">
                    @auth
                    <a href="{{ route('forum') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Forum</a>
                        <a href="{{ route('profile.show') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Profile</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif


        <div class="max-w-4xl mx-auto pt-5 my-4 bg-gray-800 text-white grid grid-cols-1 gap-8 divide-y divide-gray-300">
            @php $i=1 @endphp
            @if ($categories->first())
            @foreach ($categories as $cat)
            <div class="border rounded-xl my-4 border-hidden">
                <div class="font-semibold text-xl">Category {{$i}}</div>
                <div>
                    Name: {{$cat->name}}
                </div>
                <div>
                    Description: {{$cat->description}}
                </div>
                <div>
                    # of Parts: {{$cat->parts->count()}}
                </div>
            </div>
            @php $i++ @endphp
            @endforeach
            @endif
        </div>
    </body>
</html>
