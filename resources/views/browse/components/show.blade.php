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
                {{ $part->name }}
            </div>
            <div class="flex">
                <div class="border rounded-xl shadow-xl mx-auto overflow-hidden">
                    <img src="{{ asset('storage' . $part->image) }}" class="object-cover mx-auto">
                </div>
            </div>

            <div class="mt-8 flex justify-center w-full mx-auto">
                <div
                    class="rounded-xl bg-indigo-500 hover:bg-indigo-400 transition duration-150 px-3 py-1 text-lg text-white font-semibold cursor-pointer">
                    Compare other
                </div>
            </div>

            <div class="mt-8 mx-8">
                <div class="text-2xl text-center mt-8 mb-2 border-b mx-8 py-1">
                    Item's details
                </div>
                <div class="border rounded-lg max-w-4xl mx-auto mt-8">
                    <table class="w-full">
                        <tr class="text-lg border-b">
                            <td class="w-1/2 border-r px-3 py-1 font-semibold">Brand</td>
                            <td class="w-1/2 border-l px-3 py-1">
                                <a href="{{ route('show-brand', $part->brand->id) }}">{{ $part->brand->name }}</a>
                            </td>
                        </tr>
                        <tr class="text-lg border-b">
                            <td class="w-1/2 border-r px-3 py-1 font-semibold">Category</td>
                            <td class="w-1/2 border-l px-3 py-1">
                                <a href="{{ route('show-category', $part->category->id) }}">{{ $part->category->name }}</a>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="text-2xl text-center mt-8 mb-2 border-b mx-8 py-1">
                    Item Specification
                </div>
                <div class="border rounded-lg max-w-4xl mx-auto mt-8 overflow-hidden">
                    <table class="w-full">
                        @foreach ($partSpec as $spec)
                            <tr class="text-lg border-b">
                                <td class="w-1/2 border-r px-3 py-1 font-semibold">{{ $spec->name }}</td>
                                @if ($spec->datatype == 'number')
                                    <td class="w-1/2 border-l px-3 py-1">
                                        {{ $spec->content . ' ' . $spec->measurement }}
                                    </td>
                                @else
                                    <td class="w-1/2 border-l px-3 py-1">{{ $spec->content }}</td>
                                @endif
                            </tr>
                        @endforeach
                    </table>
                </div>

                <div class="text-2xl text-center mt-8 mb-2 border-b mx-8 py-1">
                    Reviews
                </div>
                <div class="max-w-4xl mx-auto mt-8">
                        {{-- User text form --}}
                        @auth
                            <livewire:part-review-form :part="$part">
                        @endauth
                        @if (!$part->reviews->first())
                            <div class="text-center font-semibold text-2xl text-slate-600">
                                @auth
                                No reviews yet, be the first to leave a review!
                                @endauth
                                @guest
                                No reviews yet, <span class="underline font-semibold"><a href="{{ route('login') }}">login</a></span> to leave a review!
                                @endguest
                            </div>
                        @endif

                        {{-- All reviews --}}
                        <div class="w-full flex-col-reverse flex">
                        @foreach ($part->reviews as $review)
                            <div class="border rounded-lg px-3 py-1 my-2">
                                <div class="flex items-start">
                                    @if(!is_null($review->user->profile_photo_path))
                                    <img src="/storage/{{$review->user->profile_photo_path}}" class="h-24 w-24 rounded-full">
                                    @else
                                    <img src="{{$review->user->profile_photo_url}}" class="h-24 w-24 rounded-full">
                                    @endif
                                    <div>
                                        <div class="">
                                            <div class="flex items-start">
                                                <div class="font-semibold text-xl my-auto">
                                                    {{ $review->user->name }}
                                                </div>
                                                <div class="ml-4 my-auto flex">
                                                    @for ($x=1;$x<6;$x++)
                                                    @if($review->rating < $x)
                                                    <img src="{{ asset('storage/images/svg/star_outline.svg') }}" class="h-8 w-8">
                                                    @else
                                                    <img src="{{ asset('storage/images/svg/star_solid.svg') }}" class="h-8 w-8">
                                                    @endif
                                                    @endfor
                                                </div>
                                            </div>
                                            <div class="text-lg text-slate-600">
                                                {{ $review->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                        <div class="p-3">
                                            {{ $review->text }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
