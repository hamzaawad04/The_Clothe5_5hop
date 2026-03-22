<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 text-[#14213D]">
                <p class="text-2xl mb-8">{{ __("You're logged in!") }}</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <a href="{{ route('orders.index') }}" class="block rounded-lg border border-gray-200 bg-white shadow-sm hover:shadow-md transition p-10 text-center">
                        <div class="mx-auto mb-6 flex items-center justify-center">
                            <img src="{{ asset('icons/dashboard-orders-icon.svg') }}" alt="Orders Icon" class="h-28 w-28 object-contain">
                        </div>
                        <h3 class="text-4xl font-bold text-[#14213D]">Your Orders</h3>
                        <p class="mt-4 text-2xl text-gray-500">View and track your orders</p>
                    </a>

                    <a href="{{ route('orders.returns') }}" class="block rounded-lg border border-gray-200 bg-white shadow-sm hover:shadow-md transition p-10 text-center">
                        <div class="mx-auto mb-6 flex items-center justify-center">
                            <img src="{{ asset('icons/dashboard-returns-icon.svg') }}" alt="Returns Icon" class="h-28 w-28 object-contain">
                        </div>
                        <h3 class="text-4xl font-bold text-[#14213D]">Returns & Refunds</h3>
                        <p class="mt-4 text-2xl text-gray-500">Manage returns and refunds</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@include('components.footer')
