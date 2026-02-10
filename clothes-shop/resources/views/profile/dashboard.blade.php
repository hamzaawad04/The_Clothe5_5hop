<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
</x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-black">
                    {{ __("You're logged in!") }}

                    <!-- Added spacing: two lines down -->
                    <div class="mt-8 grid grid-cols-2 gap-6">
                        <button class="w-full px-6 py-3 bg-[#14213D] text-[#FCA311] font-semibold rounded hover:bg-[#FCA311] hover:text-[#14213D] transition">
                            YOUR ORDERS
                        </button>
                        <button class="w-full px-6 py-3 bg-[#14213D] text-[#FCA311] font-semibold rounded hover:bg-[#FCA311] hover:text-[#14213D] transition">
                            RETURNS AND REFUNDS
                        </button>
                        <button class="w-full px-6 py-3 bg-[#14213D] text-[#FCA311] font-semibold rounded hover:bg-[#FCA311] hover:text-[#14213D] transition">
                            PAYMENTS METHODS
                        </button>
                        <button class="w-full px-6 py-3 bg-[#14213D] text-[#FCA311] font-semibold rounded hover:bg-[#FCA311] hover:text-[#14213D] transition">
                            SETTINGS
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@include('components.footer')