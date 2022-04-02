<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PC Builder | Homepage</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @livewireStyles
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

</head>

<body class="antialiased bg-gray-900">
    @include('components.navbar')

    <hr class="my-10 border-none">

    <center>
        <p class="text-white z-30 mt-10 text-center first-letter: text-6xl">Welcome to PC Builder!</p>
            <p class="text-white z-30 text-center first-letter: text-3xl">Build your favourite customized PC today!</p>

            <hr class="my-10 border-none">
                        <div class="slideshow px-0 w-1/2 mx-auto width:500 height:500">

                            <div class="mySlides ">
                                <img src="{{asset('storage/images/Homepage/heroimage.jpg') }}"/>
                            </div>
                            <div class="mySlides " >
                                <img src="{{asset('storage/images/Homepage/heroimage2.jpg') }}"  />
                            </div>
                            <div class="mySlides " >
                                <img src="{{asset('storage/images/Homepage/heroimage3.jpg') }}" />
                            </div>
                                <div class="text-center bg-white">
                                <span class="dot"></span>
                                </div>
                        </div>
    </center>

    <hr class="my-16 border-none">

    <div class="mx-48 overflow-x-hidden">
        <center>
            <div class="ml-auto flex text-3xl text-center w-full h-full align-center mx-48 overflow-x-hidden">
                <div class="text-center my-44 w-1/2 text-white">
                    <p>Choose your customized build!</p>
                    <p>Anywhere from GT to RTX Series!</p>
                    <br>
                    <a href="{{route('browse-components')}}" class="outline-offset-1 rounded-lg border-solid border-4 border-indigo-500 border-x-gray-900">Shop Now</a>
                </div>

                <div class="w-1/2">
                    <img src="{{asset('storage/images/Homepage/gttortx.jpg') }}">
                </div>
            </div>
        </center>
    </div>

    <div class="mx-48 overflow-x-hidden">
        <center>

            <div class="ml-auto flex text-3xl text-center w-full h-full align-center mx-48 overflow-x-hidden">
                <div class="w-1/2">
                    <img src="{{ asset('storage/images/Homepage/custombuild.jpg') }}">
            </div>
            <div class=" text-center my-44 w-1/2 text-white">
                    <p>Some of our RGB custom builds!</p>
                    <p>Want to know the guides for the builds?</p>
                    <br>
                    <a href="{{route('pc-builder-guide')}}" class="outline-offset-1 rounded-lg border-solid border-4 border-indigo-500 border-x-gray-900">PC Builder Guide</a>
                </div>

            </div>
        </center>
    </div>
    <hr class="my-16 border-none">

    <div class="mx-48 overflow-hidden text-3xl mb-20">
        <center>
            <p class="text-center text-white"> Any Inqueries?
            <a href="{{route('about-us')}}" class="border-x-gray-900 hover:normal-case hover:text-indigo-500 ">Contact us</a> now!</p>
        </center>
    </div>
</body>
<footer>
    <p class="text-center text-gray-500">© 2022 PC Builder |
    <a href="{{route('policy.show')}}">Policy</a> |
    <a href="{{route('terms.show')}}">Terms</a>
</p>
</footer>
<script type="text/javascript" async="async">

    var slideIndex = 0;
    showSlides();

    function currentSlide(n) {
        showSlides(slideIndex = n);
        resetTimer();
    }

    function resetTimer() {
        clearInterval(timer);
        timer = setInterval(showSlides, 3000);
    }

    function showSlides() {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");

        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {
            slideIndex = 1;
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";

    }

    timer = setInterval(showSlides, 3000);

    </script>

</html>
