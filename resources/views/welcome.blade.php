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

    <body class="antialiased dark:bg-gray-900">
        <div class="absolute top-0 h-14 w-full bg-white z-10 px-8 flex justify-center">
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
        <hr class="my-10 bg-black border-none">

        <div class="relative flex items-top justify-center bg-gray-100 dark:bg-gray-900 py-4 sm:pt-0 mx-auto">
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
        </div>
        <div class="text-white z-30 mt-10 text-center first-letter: text-7xl">Build your custom pc!</div>
            <div class ="w-full h-full sm:items-center">
                <img src ={{asset('Images/custompc.png') }} draggable="false" alt="Hero Image" class="img-fluid w-full h-full ">
            @livewireScripts
        </div>

    <hr class="my-16 bg-black border-none">

    <div class="mx-48 sm:my-2 md:my-5 lg:my-10 overflow-x-hidden" >
        <center>

        <div class="ml-auto flex text-3xl text-center w-full h-full align-center mx-48 overflow-x-hidden">
            <div class="text-center my-20 w-1/2 text-white">
                <p>Choose your customized build! Anywhere from GT to RTX Series!</p>
            </div>
            <div class="w-1/2">
                <img src ={{{ asset('Images/custom1.jpg') }}} >
            </div>

        </div>
        </center>
    </div>

    <hr class="my-16 bg-black border-none">

    <div class="mx-48 sm:my-2 md:my-5 lg:my-10 overflow-x-hidden" >
        <center>

        <div class="ml-auto flex text-3xl text-center w-full h-full align-center mx-48 overflow-x-hidden">
            <div class="w-1/2">
                <img src ={{{ asset('Images/contact us.png') }}} >
            </div>
            <div class="text-center my-20 w-1/2 text-white">
                <p>Any Inqueries? Contact us now!</p>
            </div>

        </div>
        </center>
    </div>

    </body>
</html>

