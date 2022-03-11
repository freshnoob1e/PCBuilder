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
            @if ($categories->first())
            @foreach ($categories as $cat)
            <div class="border rounded-xl my-4">
                <div class="font-semibold text-xl">Part {{$i}}</div>
                <div>
                    Name: {{$cat->name}}
                </div>
                <div>
                    Description: {{$cat->description}}
                </div>
                <div>
                    # of Parts: {{$cat->parts->count()}}
                </div>
            </div>
            @php $i++ @endphp
            @endforeach
            @endif
        </div>
    </body>
</html>
