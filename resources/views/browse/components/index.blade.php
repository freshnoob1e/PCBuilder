<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>PCPartPicker | Browse Components</title>

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
                Here are all the parts that is essential for building your custom PC!
            </h1>
        </div>
        <div class="mx-auto text-center text-3xl font-semibold mb-3 mt-6">
            ALL COMPONENTS
        </div>
        <div class="relative flex items-start justify-center min-h-screen py-4 max-w-7xl mx-auto">
            <div class="w-full grid grid-cols-3 gap-5">
                @foreach ($parts as $part)
                <div class="border rounded-xl shadow-lg p-3">
                    <div>
                        <a href="{{ route('show-component', $part->id) }}">
                            <img src="{{ asset('storage'.$part->image) }}" class="mx-auto transition duration-150 transform hover:-translate-y-1 hover:shadow-2xl">
                        </a>
                    </div>
                    <div class="flex justify-center items-start mx-auto">
                        <a href="{{ route('show-component', $part->id) }}">
                            <div class="text-2xl font-semibold text-center transition duration-150 hover:shadow hover:border-b-2 hover:border-b-indigo-400">
                                {{$part->name}}
                            </div>
                        </a>
                    </div>
                    <div class="flex justify-center items-start mx-auto">
                        <a href="{{ route('show-brand', $part->brand->id) }}">
                            <div class="text-2xl font-semibold text-center transition duration-150 hover:shadow hover:border-b-2 hover:border-b-indigo-400">
                                {{$part->brand->name}}
                            </div>
                        </a>
                    </div>
                    <div class="flex flex-col justify-center items-start">
                        <div class="text-center mx-auto flex mt-4">Average Rating</div>
                        <div class="flex text-center mx-auto">
                            @for ($x=1;$x<6;$x++)
                            @if($part->avgRating < $x)
                            <img src="{{ asset('storage/images/svg/star_outline.svg') }}" class="h-8 w-8">
                            @else
                            <img src="{{ asset('storage/images/svg/star_solid.svg') }}" class="h-8 w-8">
                            @endif
                            @endfor
                        </div>
                        <div class="text-center mx-auto flex">{{ $part->reviews->count() }} reviews</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </body>
</html>

