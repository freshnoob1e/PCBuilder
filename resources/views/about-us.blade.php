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
    <body class="antialiased text-slate-50 dark:text-slate-400 bg-slate-900">
        <div class="absolute top-0 h-14 w-full bg-slate-900 z-10 px-8 flex justify-center">
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
        <div class="relative flex items-top justify-center bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
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
    {{-- aaaaaaaaaaaaa --}}
    <div class="text-center mx-auto font-bold text-9xl mt-20">About Us</div>

    <div class="w-full md:max-w-3xl lg:max-w-4xl xl:max-w-5xl mx-auto sm:my-2 md:my-5 lg:my-10 overflow-x-hidden routeMinHeight">
    <h1 class="text-center ">Our Story</h1>
    </br>
    <p class="">Supreme Computer Systems is a Malaysia IT company focused on providing quality services and solutions to satisfy customers needs. Founded in  22nd July 2001 in Kuantan, Pahang, Supreme Computer Systems has fulfilled and satisfied all customer with excellent services to this date. From the day we start our business, we only been receiving nothing else but complimenets for our top-notch customer service and after sales service. Supreme Computer Systems has sold a wide variety of Softwares and Hardwares to many companies and customers, fulfilling their needs for technological advancement.</p>
    </br>
    <h1 class="text-center">Our Goal</h1>
    </br>
    <p>“SCS ‘s goal is to improve and enhance the competitive position of our clients by providing them what they want and desire and continuously servicing them with a full range of professional and quality services. We prioritize customer satisfaction by providing guidance and solutions to all our customer's needs, allowing you to prioritize on your business objectives.

       Although we are founded in the early days, our team is still growing and aiming to achieve more in the future. We are a team equipped with highly motavated, well-trained and dedicated staffs.”</p>
    </br>
	<h1 class="text-center">Why us ?</h1>
</br>
    <p>SCS is one of the leading online e-tailers with presences in 3 countries; Australia, Malaysia and Singapore.We offer a wide selection of top brand IT products with the most competitive prices in the local market. In 3 years, we were awarded the Malaysia Top IT Product E-Commerce reseller in Lazada and Shopee and achieved 5 stars rating from over 30,000 reviews.</p>

    </div>
</body>
</html>
