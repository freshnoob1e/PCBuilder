<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>PCPartPicker | Guide</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        @livewireStyles
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    </head>
    <body class="antialiased bg-black	">
        {{-- aaaaaaaaaaaaa --}}

        <div>
            <div class=" text-center mx-auto font-bold text-9xl text-slate-50">PC Builder Guide
        <img src="{{ asset('storage/images/guide/bg.jpg') }}" class = "z-1 w-full h-screen ">

        </div>
    </div>
    </body>
</html>
