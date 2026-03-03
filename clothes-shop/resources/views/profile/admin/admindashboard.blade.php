<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-8">

                <!-- Welcome Message -->
                <h3 class="text-3xl font-bold text-[#14213D] mb-8">
                    Welcome back Admin :)
                </h3>

                <!-- 12‑Card Admin Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                    @php
                        $cards = [
                            'Product Management',
                            'Orders Management',
                            'Customer Management',
                            'Inventory & Supply Chain',
                            'Sales & Analytics',
                            'Marketing & Promotions',
                            'Website & Content Management',
                            'User Roles & Permissions',
                            'Payments & Finances',
                            'Security & Settings',
                        ];
                    @endphp

                    @foreach ($cards as $card)
                        <a href="#"
                           class="block bg-[#14213D] text-[#FCA311] font-semibold text-center py-6 rounded-lg shadow hover:bg-[#FCA311] hover:text-[#14213D] transition">
                            {{ $card }}
                        </a>
                    @endforeach

                </div>

            </div>
        </div>
    </div>
</x-app-layout>

@include('components.footer')