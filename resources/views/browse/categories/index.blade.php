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
        <div class="text-white text-center font-semibold text-xl pt-1 my-1 bg-slate-500">
            <h1>
                These are the components that are essential for building your custom PC!
                Here are all the categories showing our number of parts that are available for viewing!
            </h1>
        </div>
        <div class="mx-auto text-center text-3xl font-semibold mb-3 mt-6">
            ALL CATEGORIES
        </div>
        <div class="relative flex items-start justify-center min-h-screen py-4 max-w-7xl mx-auto">
            <div class="w-full grid grid-cols-3 gap-5">
                @foreach ($categories as $cat)
                <div class="border rounded-xl shadow-lg p-3">
                    <div class="flex justify-center items-start mx-auto">
                        <a href="{{ route('show-category', $cat->id) }}">
                            <div class="text-2xl font-semibold text-center transition duration-150 hover:shadow hover:border-b-2 hover:border-b-indigo-400">
                                {{$cat->name}}
                            </div>
                        </a>
                    </div>
                    <div>
                        {{ $cat->description }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </body>
</html>
