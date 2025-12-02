<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

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
        <div class="mx-auto max-w-5xl px-4 py-10">
      <h1 class="mb-10 text-center text-3xl font-bold text-white">Contact Us</h1>

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
        <div class= "bg-white p-6">
          <form>
            <!-- Name -->
            <label>
              Name
              <input type="text" name="name" class="mt-1 w-full rounded-md border p-2" placeholder="Enter name" required />
            </label>

            <!-- Email -->
            <label>
             Email
              <input type="email" name="email" class="mt-2 w-full rounded-md border p-2" placeholder="Enter email" required />
            </label>

            <!-- Message -->
            <label>
              Message
              <textarea name="message" class="mt-2 w-full rounded-md border p-2" rows="4" placeholder="Enter your message" required></textarea>
            </label>

            <!-- Button -->
            <button type="submit" class="hover:bg-primary hover:text-white w-full rounded-md bg-gray-300 px-4 py-2 text-black">Submit</button>
          </form>
        </div>
      </div>
    </div>    
    </main>
     @include('components.footer')
</body>
</html>