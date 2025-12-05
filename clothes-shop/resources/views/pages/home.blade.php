<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>THE CLOTHE5 5HOP</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

<body class = "font-playfair text-black">
    @include('components.mainnavbar')

    <main>
        <div class="relative w-full">
        <img src="{{ asset('images/herobanner1.png') }}" alt="Model Logo" class="w-full h-auto">

        <a href="{{ route('about') }}" class="absolute bottom-[22%] left-[14%] px-8 py-4 border border-cathover text-3xl text-white rounded-lg hover:text-cathover">About Us</a>
        </div>

        <div class="relative w-full">
        <img src="{{ asset('images/herobannertops.png') }}" alt="Model Logo" class="w-full h-auto">

        <a href="{{ route('products.tops') }}" class="absolute bottom-[22%] right-[14%] px-8 py-4 border border-cathover text-3xl text-white rounded-lg hover:text-cathover">Tops</a>
        </div>

        <div class="relative w-full">
        <img src="{{ asset('images/herobannerbottoms.png') }}" alt="Model Logo" class="w-full h-auto">

        <a href="{{ route('products.bottoms') }}" class="absolute bottom-[22%] left-[14%] px-8 py-4 border border-cathover text-3xl text-white rounded-lg hover:text-cathover">Bottoms</a>
        </div>

        <div class="relative w-full">
        <img src="{{ asset('images/herobannerouterwear.png') }}" alt="Model Logo" class="w-full h-auto">

        <a href="{{ route('products.outerwear') }}" class="absolute bottom-[22%] right-[14%] px-8 py-4 border border-cathover text-3xl text-white rounded-lg hover:text-cathover">Outerwear</a>
        </div>

        <div class="relative w-full">
        <img src="{{ asset('images/herobannerfootwear.png') }}" alt="Model Logo" class="w-full h-auto">

        <a href="{{ route('products.footwear') }}" class="absolute bottom-[22%] left-[14%] px-8 py-4 border border-cathover text-3xl text-white rounded-lg hover:text-cathover">Footwear</a>
        </div>

        <div class="relative w-full">
        <img src="{{ asset('images/herobanneraccessories.png') }}" alt="Model Logo" class="w-full h-auto">

        <a href="{{ route('products.accessories') }}" class="absolute bottom-[22%] right-[14%] px-8 py-4 border border-cathover text-3xl text-white rounded-lg hover:text-cathover">Accessories</a>
        </div>
    </main>
     @include('components.footer')
</body>
</html>