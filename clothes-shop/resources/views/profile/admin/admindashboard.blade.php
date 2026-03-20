<x-app-layout>
    <x-slot name="header">
        <div class="ml-64">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Admin Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <x-admin-sidebar/>

    <div class="py-12 ml-64">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-8">

                <!-- Welcome Message -->
                <h3 class="text-3xl font-bold text-[#14213D] mb-8">
                    Welcome back Admin :)
                </h3>

                <!-- Normal User Dashboard Options -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                    <div class="p-6 text-black">
                        {{ __("You're logged in!") }}

                        <div class="mt-8 grid grid-cols-2 gap-6">
                            <a href="{{ route('admin.products.index') }}" class="block w-full px-6 py-3 bg-[#14213D] text-[#FCA311] font-semibold rounded text-center hover:bg-[#FCA311] hover:text-[#14213D] transition">
                                Product Management
                            </a>
                            <a href="{{ route('admin.orders.index') }}" class="block w-full px-6 py-3 bg-[#14213D] text-[#FCA311] font-semibold rounded text-center hover:bg-[#FCA311] hover:text-[#14213D] transition">
                                Order Management
                            </a>
                            <a href="#" class="block w-full px-6 py-3 bg-[#14213D] text-[#FCA311] font-semibold rounded text-center hover:bg-[#FCA311] hover:text-[#14213D] transition">
                                Customer Management
                            </a>
                            <a href="#" class="block w-full px-6 py-3 bg-[#14213D] text-[#FCA311] font-semibold rounded text-center hover:bg-[#FCA311] hover:text-[#14213D] transition">
                                Inventory & Supply Stock
                            </a>
                        </div>
                        <div class="mt-8 grid grid-cols-2 gap-6">
                            <a href="{{ route('admin.sales-analytics')}}" class="block w-full px-6 py-3 bg-[#14213D] text-[#FCA311] font-semibold rounded text-center hover:bg-[#FCA311] hover:text-[#14213D] transition">
                                Sales & Analytics
                            </a>
                            <a href="#" class="block w-full px-6 py-3 bg-[#14213D] text-[#FCA311] font-semibold rounded text-center hover:bg-[#FCA311] hover:text-[#14213D] transition">
                                User Roles & Permissions
                            </a>
                            <a href="#" class="block w-full px-6 py-3 bg-[#14213D] text-[#FCA311] font-semibold rounded text-center hover:bg-[#FCA311] hover:text-[#14213D] transition">
                                Payments & Shipments
                            </a>
                        </div>
                    </div>
                </div>

            

            </div>
        </div>
    </div>
</x-app-layout>

@include('components.footer')
