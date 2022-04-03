{{-- AUTHOR: CHAN ZHENG JIE / ONG CHOON TECK / POH YUAN HAO --}}
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
    <div class="max-w-7xl min-h-screen mx-auto">
        <div class="border rounded-xl mx-auto mt-24 py-5">
            <div class="mx-auto text-center text-4xl">
                {{ $category->name }}
            </div>
            <div class="text-2xl text-center mt-8 mb-2 border-b mx-8 py-1">
                Category's items
            </div>
            <div class="mt-8 mx-8 grid grid-cols-4 gap-4">
                @foreach ($category->parts as $part)
                    <div class="border rounded-lg shadow-lg py-2">
                        <a href="{{ route('show-component', $part->id) }}">
                            <img src="{{ asset('storage' . $part->image) }}" class="object-cover mx-auto">
                        </a>
                        <div class="px-6 text-center">
                            <a href="{{ route('show-component', $part->id) }}">
                                <div class="text-2xl underline">{{ $part->name }}</div>
                            </a>
                            <a href="{{ route('show-brand', $part->brand->id) }}">
                                <div class="text-xl">{{ $part->brand->name }}</div>
                            </a>
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
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</body>

</html>
