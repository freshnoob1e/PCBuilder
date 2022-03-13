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
        <div class="max-w-4xl mx-auto">
            @php $i=1 @endphp
            @if ($parts->first())
            @foreach ($parts as $part)
            <div class="border rounded-xl my-4">
                <div class="font-semibold text-2xl">Part {{$i}}</div>
                <div class="flex">
                    Image: <img src="{{ asset('storage/'.$part->image) }}">
                </div>
                <div class="font-bold">
                    Name: {{$part->name}}
                </div>
                <div>
                    Description: {{$part->description}}
                </div>
                <div class="flex">
                    Category:
                    <div class="border m-2 p-2 rounded-xl">
                        <div>Name: {{$part->category->name}}</div>
                        <div>Description: {{$part->category->description}}</div>
                    </div>
                </div>
                <div class="flex">
                    Brand:
                    <div class="border m-2 p-2 rounded-xl">
                        <div class="flex"><img src="{{asset('storage/'.$part->brand->image)}}" class="w-24 h-24 object-cover"></div> <!-- Brand Img -->
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
