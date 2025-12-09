   <!-- Logo -->
   <header class="w-full flex items-center px-6 py-3">
    <div class="w-1/4">
        <a href="/" class="flex items-center space-x-6">
        <img src="/images/mainlogo.jpg" alt="Logo icon" class="h-20 w-auto object-contain" />
    </a>
    </div>
    
  <!-- Search -->
       <div class="flex-grow max-w-lg mx-auto">
           <div class="relative">
               <input type="text" placeholder="Search..." class="w-full pl-12 pr-4 py-2 bg-gray-200 rounded-md focus:ring-cathover border-none" />
               <img src="/icons/search.svg" class="w-6 h-6 absolute left-3 top-1/2 -translate-y-1/2" alt="Search icon">
           </div>
       </div>

       <!-- Icons -->
        
            <div class="flex items-center space-x-6 w-1/4 justify-end relative" x-data = "{open : false}">
            @guest
                <button @click = "open = !open">
                 <img src="/icons/account.svg" alt="Account" class="w-6 h-6">
                </button>

        <div class="absolute top-7 mt-2 bg-gray-100 rounded-md right-20" x-show = "open" @click.away = "open = false">

        <x-dropdown-link :href="route('login')">
            {{ __('Login') }}
        </x-dropdown-link>

        <x-dropdown-link :href="route('register')">
            {{ __('Register') }}
        </x-dropdown-link>
        </div>
        @endguest

        @auth
           <a href="{{ url('/dashboard') }}"><img src="/icons/account.svg" alt="Account" class="w-6 h-6"></a>
        @endauth

           <a href="#"><img src="/icons/basket.svg" alt="Basket" class="w-7 h-9"></a>

           <a href="#"><img src="/icons/wishlist.svg" alt="Wishlist" class="w-10 h-6"></a>

       </div>
   </header>

    