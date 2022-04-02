<link rel="stylesheet" href="{{asset('css/navbar.css')}}">
<div class="mb-10">
    <div class="absolute top-0 h-14 w-full bg-white z-10 px-8 flex justify-center border-b">
        <ul class="flex space-x-12 my-auto font-semibold text-xl justify-between">
            <li>
                <a href="{{route('pc-builder')}}">PC BUILDER</a>
            </li>
            <li class="relative dropdown">
                BROWSE
                <ul class="absolute dropdownContent">
                    <li class="border border-t-0 border-gray-300 bg-white">
                        <a href="{{route('browse-components')}}">BY COMPONENTS</a>
                    </li>
                    <li class="border border-t-0 border-gray-300 bg-white">
                        <a href="{{route('browse-brands')}}">BY BRANDS</a>
                    </li>
                    <li class="border border-t-0 border-gray-300 bg-white">
                        <a href="{{route('browse-categories')}}">BY CATEGORIES</a>
                    </li>
                </ul>
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
        @livewireScripts
    </div>
</div>
