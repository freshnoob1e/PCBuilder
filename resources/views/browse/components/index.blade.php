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
        <div class="absolute top-0 h-14 w-full bg-white z-10 px-8 flex justify-center space-y-9">
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
        <div class="text-white text-center font-semibold text-xl pt-14 my-1"><h1>These are the components that are essential for building your custom PC! Here are all the parts that is essential for building your custom PC!</h1></div>
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

        <div class="max-w-4xl mx-auto bg-gray-800 text-white grid grid-cols-2 gap-10 place-content-evenly pl-7 divide-x-2 pt-4">
            @php $i=1 @endphp
            @if ($parts->first())
            @foreach ($parts as $part)
            <div class=" my-4 ">
                <div class="font-semibold text-2xl">Item {{$i}}</div>
                <div class="flex">
                    Image: <img src="{{ asset('storage'.$part->image) }}">
                </div>
                <div class="font-bold text-xl pb-4">
                    Name: {{$part->name}}
                </div>
                <div class="pb-4">
                    Description: {{$part->description}}
                </div>
                <div class="flex">
                    Category:
                    <div class="border m-2 p-3 rounded-xl border-hidden">
                        <div>Name: {{$part->category->name}}</div>
                        <div>Description: {{$part->category->description}}</div>
                    </div>
                </div>
                <div class="flex">
                    Brand:
                    <div class="border m-2 p-2 rounded-xl">
                        <div class="flex"><img src="{{asset('storage'.$part->brand->image)}}" class="w-24 h-24 object-cover"></div> <!-- Brand Img -->
                        <div class="font-mono font-semibold">{{$part->brand->name}}</div> <!-- Brand Name -->
                    </div>
                </div>
            </div>
            @php $i++ @endphp
            @endforeach
            @endif
        </div>
    </body>
</html>

