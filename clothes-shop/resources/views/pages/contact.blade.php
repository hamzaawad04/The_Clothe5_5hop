<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Contact Us</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

<body class = "font-playfair text-black">
    @include('components.mainnavbar')
    
    <main class="bg-primary">
        <div class="mx-auto max-w-3xl px-4 py-10">
      <h1 class="mb-10 text-center text-4xl font-bold text-white">Contact Us</h1>

      @if(session('success'))
  <div class="my-6 px-4 py-4 bg-green-100 text-green-900 rounded-md text-center">
    {{ session('success') }}
  </div>
@endif


      <div class="flex">

        <!-- Contact Details -->
        <div class="bg-white p-6">
          <h2 class="mb-4 text-2xl font-semibold">Contact Details</h2>

          <div class="space-y-3 text-black">
            <p>
              <span class="font-semibold">Email:</span><br />
              TheClothe55hop@gmail.com
            </p>

            <p>
              <span class="font-semibold">Phone:</span><br />
              +44 1111 22222
            </p>

            <p>
              <span class="font-semibold">Address:</span><br />
              Aston St<br />
              B4 7ET<br />
              United Kingdom
            </p>
          </div>
        </div>

        <!--Contact Form -->
        <div class= "bg-white p-6 w-full">
          <form method="POST" action="{{ route('contact.store')}}">
            <!-- add csrf token for security -->
            @csrf
            <!-- Name -->
            <div>
              <x-input-label for="name" :value="__('Name')" />
              <x-text-input id="name" class="mb-1 w-full rounded-md border p-2" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
              <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email -->
            <div>
              <x-input-label for="email" :value="__('Email')" />
              <x-text-input id="email" class="mb-1 w-full rounded-md border p-2" type="email" name="email" :value="old('email')" required autofocus autocomplete="email" />
              <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Message -->
            <div>
              <x-input-label for="message" :value="__('Message')" />
              <textarea id="message" name="message" class="mb-1 w-full rounded-md border p-2 h-40" required autofocus autocomplete="message"></textarea>
              <x-input-error :messages="$errors->get('message')" class="mt-2" />
            </div>

            <!-- Button -->

            <x-primary-button class="ms-4">
                {{ __('Submit Message') }}
            </x-primary-button>
          </form>
        </div>
      </div>
    </div>    
    </main>
     @include('components.footer')
</body>
</html>