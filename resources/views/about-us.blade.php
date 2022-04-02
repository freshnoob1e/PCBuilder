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

<body class="antialiased bg-slate-900">
    @include('components.navbar')
    <div class="text-center mx-auto font-bold text-9xl mt-20 text-slate-50 dark:text-slate-400">About Us</div>

    <div class="w-full md:max-w-3xl lg:max-w-4xl xl:max-w-5xl
                mx-auto sm:my-2 md:my-5 lg:my-10 overflow-x-hidden routeMinHeight
                text-slate-50 dark:text-slate-400">
        <h1 class="text-center text-5xl">Our Story</h1>
        <br />
        <p class="">Supreme Computer Systems is a Malaysia IT company focused on providing quality services
            and solutions to satisfy customers needs. Founded in 22nd July 2001 in Kuantan, Pahang, Supreme Computer
            Systems has fulfilled and satisfied all customer with excellent services to this date. From the day we start
            our business, we only been receiving nothing else but complimenets for our top-notch customer service and
            after sales service. Supreme Computer Systems has sold a wide variety of Softwares and Hardwares to many
            companies and customers, fulfilling their needs for technological advancement.</p>
        <br />
        <h1 class="text-center text-5xl">Our Goal</h1>
        <br />
        <p>
            “SCS ‘s goal is to improve and enhance the competitive position of our clients by providing them what they
            want and desire and continuously servicing them with a full range of professional and quality services. We
            prioritize customer satisfaction by providing guidance and solutions to all our customer's needs, allowing
            you to prioritize on your business objectives.
            Although we are founded in the early days, our team is still growing and aiming to achieve more in the
            future. We are a team equipped with highly motavated, well-trained and dedicated staffs.”
        </p>

        <br />
        <h1 class="text-center text-5xl">Contact us</h1>
        <br/>
    <p class="text-center">Having troubles or any questions? Feel free to contact us anytime, we are glad to assist you!</p>
	<p class="text-center"> Whatsapp our sales and technical team at: +6019-3491 2323</p>
	<p class="text-center"> Support Email: support@bruh.my</p>
	<p class="text-center">Working Hour: 10:00 A.M. - 7:30 P.M. Everyday</p>


    </div>
</body>

</html>
