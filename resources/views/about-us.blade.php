<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PCPartPicker | About Us</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @livewireStyles
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

</head>

<body class="antialiased bg-slate-900">
    @include('components.navbar')
    <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0 ">About Us

    <div class="w-full mt-6 p-6 mx-auto bg-white shadow-md overflow-hidden sm:rounded-lg prose ">
        <h1 class="text-center text-5xl">Our Story</h1>

        <p class="text-xl">PCPartPicker is a Malaysia IT company focused on providing quality services
            and solutions to satisfy customers needs. Founded in 22nd July 2001 in Kuantan, Pahang, PCPartPicker
            has fulfilled and satisfied all customer with excellent services to this date. From the day we start
            our business, we only been receiving nothing else but complimenets for our top-notch customer service and
            after sales service. PCPartPicker has sold a wide variety of Softwares and Hardwares to many
            companies and customers, fulfilling their needs for technological advancement.</p>
        <br />
        <h1 class="text-center text-5xl">Our Goal</h1>

        <p class="text-xl">
            “PCPartPicker‘s goal is to improve and enhance the competitive position of our clients by providing them what they
            want and desire and continuously servicing them with a full range of professional and quality services. We
            prioritize customer satisfaction by providing guidance and solutions to all our customer's needs, allowing
            you to prioritize on your business objectives.
            Although we are founded in the early days, our team is still growing and aiming to achieve more in the
            future. We are a team equipped with highly motavated, well-trained and dedicated staffs.”
        </p>
        <br />
        <h1 class="text-center text-5xl">Contact us</h1>
        <div class="text-center text-xl">
            <p>Having troubles or any questions? Feel free to contact us anytime, we are glad to assist you!</p>
	        <p>Whatsapp our sales and technical team at: +6019-3491 2323</p>
	        <p>Support Email: support@bruh.my</p>
	        <p>Working Hour: 10:00 A.M. - 7:30 P.M. Everyday</p>
        </div>
    </div>
</div>

</body>

</html>
