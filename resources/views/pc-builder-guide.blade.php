{{-- AUTHOR: ONG CHOON TECK --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>PCPartPicker | Guide</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        @livewireStyles
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    </head>
    <body class="antialiased bg-slate-900 w-full	">

            <div class=" text-center mx-auto font-bold text-9xl text-slate-50">PC Builder Guide

        </div>
        <br/>
            <p class ="text-slate-50 text-left w-3/4 mx-auto text-4xl">Cpu/Processor <p/>
        <br/>
        <br/>
              <p class ="text-slate-50 text-left w-3/12 mx-auto text-4xl">TEAM BLUE or TEAM RED? <p/>
         <br/>
         <br/>

                 <div class= "flex flex-row mx-auto w-2/4 ">
                    <img src="{{asset('storage/images/parts/1647292556_Intel i5-12600.webp')}}" class ="mx-auto">
                    <img src="{{asset('storage/images/parts/1647292211_Ryzen 5 5600X.webp')}}" class ="mx-auto">

        </div>
        <br/>
        <br/>
              <p class ="text-slate-50 text-left w-3/4 mx-auto text-4xl"> Motherboards <p/>

             <center>
                <div class ="scale-150 my-32">
                     <img src="{{asset('storage/images/parts/1647291745_Asus ROG Strix X570-E.webp')}}">
               </div>
            </center>

        <br/>


              <p class ="text-slate-50 text-left w-3/4 mx-auto text-4xl"> Motherboards form factor</p>
                <br/>
                <br/>
              <p class ="text-slate-50 text-left w-3/4 mx-auto text-2xl">form factor should be considered when choosing
                  a motherboard as smaller boards<br/>can fit less ram and have smaller gpu slot as
                  well as fewer SATA connections.  <p/>
                  <br/>
                  <br/>
              <p class ="text-slate-50 text-left w-3/4 mx-auto text-2xl">These are the most commonly used form factors for a standard
                   desktop computer.</p>
                   <br/>
                  <ul class="text-slate-50 text-left w-3/4 mx-auto text-2xl ">
                      <li>•Mini ITX</li>
                      <li>•Micro ATX</li>
                      <li>•ATX</li>
                      <li>•EATX</li>
                  </ul>
                  <br/>
                  <br/>
                <center>
                    <img src="{{asset('storage/images/guide/mobo.webp')}}">
                </center>
                <br/>
                <br/>
             <p class="text-slate-50 text-left w-3/4 mx-auto text-4xl"> Motherboard Compatibility</p>
             <br/>
             <br/>

             <p class="text-slate-50 text-left w-3/4 mx-auto text-2xl"> Aside from size, motherboards have different sockets
                 which are AM4 and LGA. AMD processors will<br/> only work on motherboards that have
                AM4 sockets like X570 and B550 while INTEL cpu works on LGA sockets.</p>

                <br/>
                <center>
                    <div class=" my-20 w-full">
                    <img src="{{asset('storage/images/guide/ram.jpg')}}">
                    </div>
                </center>



            <p class="text-slate-50 text-left w-3/4 mx-auto text-4xl">RAM</p>
            <br/>
            <p class="text-slate-50 text-left w-3/4 mx-auto text-2xl">RAM, or Random Access Memory, is often
                 misunderstood and can be confusing when it comes to speeds and what it’s compatible with.</p>
                <br/>
                <br/>
            <p class="text-slate-50 text-left w-3/4 mx-auto text-4xl">Capacity</p>
            </br>
            <p class="text-slate-50 text-left w-3/4 mx-auto text-2xl">Most casual users won't have to think about running out
                of RAM, but you might want to <br/>create a monster system and go all out. If this is the case,
                pay close attention to<br/> the maximum memory capacity of your motherboard.
                <br/><br/>

                A modern motherboard will typically support up to 64GB of RAM, however some will
                support more or less.
                <br/>
                <br/>
            <p class="text-slate-50 text-left w-3/4 mx-auto text-4xl">Speed</p>
            <br/>
            <p class="text-slate-50 text-left w-3/4 mx-auto text-2xl">When it comes to RAM, the most important element is speed.
                The stock speed for DDR4 (the current <br/>generation of RAM) is set to 2133Mhz. Anything beyond this
                is considered an overclock.<br/><br/>

                It's not a stock speed if the RAM is rated higher than 2133Mhz. In such case, it's informing you that
                it's capable of being overclocked <br/>to the desired speed. If you want to buy RAM that runs faster than
                2133MHz, make sure your motherboard can handle it.</p>
                <br/>
                <br/>
            <p class="text-slate-50 text-left w-3/4 mx-auto text-4xl">Channels: Dual or Quadruple</p>
            <br/>
            <p class="text-slate-50 text-left w-3/4 mx-auto text-2xl">Double and quadruple channel RAM kits are also common, providing for
                additional bandwidth. While dual and quadruple<br/> channel RAM are the most common configurations, double-check
                which your motherboard supports.</p>


                 <center>
                    <div class=" my-16 w-full">
                    <img src="{{asset('storage/images/guide/gpu.webp')}}">
                    </div>
                </center>


                <p class="text-slate-50 text-left w-3/4 mx-auto text-4xl"> Graphic cards</p>
                <br/>
                <p class="text-slate-50 text-left w-3/4 mx-auto text-2xl">Graphic card plays a big role a boosting a
                    PCs performance, from boosting the FPS in games<br/> and improving graphics production
                    as well as rendering 2D and 3D graphics.</p>
                <br/>
                <br/>

                <center>
                    <div class="my-20 w-full">
                    <img src="{{asset('storage/images/guide/case.jpg')}}">
                    </div>
                </center>

                <p class="text-slate-50 text-left w-3/4 mx-auto text-4xl">Does a case really matter?</p>
                <br/>

                <p class="text-slate-50 text-left w-3/4 mx-auto text-2xl">OF COURSE ! there are 3 main things you need
                    to consider when choosing a case and compatibility. Cooling, graphic card clearance and
                    <br/>size. Motherboards and graphic cards comes in different sizes, so you need to choose
                    a case that fits all your needs. <br/>

                    Some smaller cases have limited space and airflow which can impact the performance of
                    the PC. Before purchasing anything,<br/> do check on the dimensions of the parts.</p>
                    <br/><br/>


                <center>
                    <div class="my w-full">
                    <img src="{{asset('storage/images/guide/fans.webp')}}">
                </center>


                <p class="text-slate-50 text-left w-3/4 mx-auto text-4xl">Cooling</p>
                <br/>
                <p class="text-slate-50 text-left w-3/4 mx-auto text-2xl">When buying a case, it typically
                    already comes with some fans. Those fans are considered acceptable for<br/> preventing
                    your PC from overheating. <br/><br/>
                    but you can opt to get a liquid or air cooler for better cooling and lower chance
                    from overheating.<br/> And before choosing a cooler, make sure that your case has
                    enough space for clearance. A liquid cooler<br/> requires a case with an appropriate
                    fan layout because it uses a radiator with one to three fans.</p>
                    <br/>
                    <br/>
                <center>
                    <div class="my-10 w-full">
                    <img src="{{asset('storage/images/guide/psu.jpg')}}">
                    </div>
                </center>


                <p class="text-slate-50 text-left w-3/4 mx-auto text-4xl">PSU</p>
                <br/>
                <P class="text-slate-50 text-left w-3/4 mx-auto text-2xl">Components have specific power requirements,
                     and it is important that the power supply meets these requirements.<br/> A pc will require
                     motherboard, cpu, gpu, Strorage and fans power in order to function to its fullest.</P>
                <br/>
                <br/>

                <center>
                    <div class="my-10 w-full">
                    <img src="{{asset('storage/images/guide/storage.jpg')}}">
                    </div>
                </center>


                <p class="text-slate-50 text-left w-3/4 mx-auto text-4xl">Storage</p>
                <br/>
                <P class="text-slate-50 text-left w-3/4 mx-auto text-2xl">There are 2 types of storage. HDD and SSD.
                    Ssd is usually used as a boot drive to store windows operating <br/>system since it has a
                    faster read and write speed while HDD is used for storing large files like games and videos.
                </p>
                </P>
               <br/><br/><br/>

               <P class="text-slate-50 text-center text-4xl">(so after you have done reading the guide
                   click<a href="{{route('pc-builder')}}" class="border-x-gray-900 hover:normal-case text-red-500	hover:text-indigo-500 ">
                    here </a>to start customizing your own pc to fulfil your requirements)</p>

                    <br/><br/>
    </body>
</html>
