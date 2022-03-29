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
    <body class="antialiased">
        @include('components.navbar')
        <div class="bg-red-900 w-full">
            heh
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

