<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>About Us</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-playfair text-black">
        @include('components.mainnavbar')
    <main class="bg-primary">

        <h1 class="py-10 mb-9 text-center text-7xl font-bold text-white">About Us</h1>

        <div class="grid grid-cols-2 mb-7 items-center">
        <img src="{{ asset('images/about1.png') }}" class="max-w-md mx-auto" alt="aboutimage1">
        <div class="px-10"> 
            <h2 class="text-6xl font-semibold text-white mb-3">Crafted By Visionaries</h2>
            <p class="text-gray-200">Every design is created by passionate student designers who bring fresh ideas to luxury fashion. Our team fuses creativity with industry inspiration to craft clothing that stands out from the ordinary</p>
        </div>
        </div>

        <div class="grid grid-cols-2 mb-7 items-center">
        <div class="px-10"> 
            <h2 class="text-6xl font-semibold text-white mb-3">Made With Precision</h2>
            <p class="text-gray-200">Quality is at the heart of what we do. Our garments are produced using premium materials and refined techniques to ensure durability and comfort in every stitch </p>
        </div>
            <img src="{{ asset('images/about2.png') }}" class="max-w-md mx-auto" alt="aboutimage2">
        </div>
            
        <div class="grid grid-cols-2 pb-7 items-center">
        <img src="{{ asset('images/about3.png') }}" class="max-w-md mx-auto" alt="aboutimage3">
        <div class="px-10"> 
            <h2 class="text-6xl font-semibold text-white mb-3">Our Mission</h2>
            <p class="text-gray-200">Our mission is to make luxury fashion accessible, inclusive and meaningful. Whether you're dressing up for work or just want to style a casual look, our pieces are crafted to help you look and feel your best. At The Clothe5 5hop, we don't just create clothes, we create an experience </p>
        </div>
        </div>
            
            


    </main>
    @include('components.footer')




    </body>
