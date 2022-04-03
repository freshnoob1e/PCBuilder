{{-- AUTHOR: LOH JIN YI --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PCPartPicker | PC Builder</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @livewireStyles
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

</head>

<body class="antialiased">
    @include('components.navbar')
    <div class="max-w-7xl min-h-screen mx-auto">
        <div class="border rounded-xl mx-auto mt-24 p-5">
            <div class="text-2xl font-semibold">
                PC Builder
            </div>
            <div class="mt-5">
                <livewire:p-c-builder>
            </div>
        </div>
    </div>
</body>

</html>
