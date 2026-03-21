<x-app-layout>

    <x-slot name="sidebar">
        <x-admin-sidebar :activeItem="'dashboard'" />
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Welcome --}}
            <div class="bg-[#14213D] rounded-lg p-6">
                <h3 class="text-2xl font-bold text-[#FCA311]">Welcome back, Admin</h3>
                <p class="text-gray-300 text-sm mt-1">Here's what needs your attention today.</p>
            </div>

            {{-- Metric Cards --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white rounded-lg shadow-sm p-5 border border-gray-100">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Total Orders</p>
                    <p class="text-3xl font-bold text-[#14213D]">{{ $totalOrders }}</p>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-5 border border-gray-100">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Total Products</p>
                    <p class="text-3xl font-bold text-[#14213D]">{{ $totalProducts }}</p>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-5 border border-gray-100">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Total Users</p>
                    <p class="text-3xl font-bold text-[#14213D]">{{ $totalUsers }}</p>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-5 border border-gray-100">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Total Revenue</p>
                    <p class="text-3xl font-bold text-[#14213D]">£{{ number_format($totalRevenue, 2) }}</p>
                </div>
            </div>

            {{-- Urgent Orders + Low Stock (side by side) --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- Urgent Orders --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                        <div>
                            <h4 class="text-base font-bold text-[#14213D]">Urgent Orders</h4>
                            <p class="text-xs text-gray-500 mt-0.5">Pending or paid — awaiting processing</p>
                        </div>
                        @if ($pendingOrdersCount > 0)
                            <span class="bg-red-100 text-red-600 text-xs font-bold px-2 py-1 rounded-full">
                                {{ $pendingOrdersCount }} need action
                            </span>
                        @else
                            <span class="bg-green-100 text-green-600 text-xs font-bold px-2 py-1 rounded-full">
                                All clear
                            </span>
                        @endif
                    </div>

                    <div class="divide-y divide-gray-50">
                        @forelse ($urgentOrders as $order)
                            <div class="px-6 py-3 flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">#{{ $order->order_id }} — {{ $order->ship_name }}</p>
                                    <p class="text-xs text-gray-500">£{{ number_format($order->total_amount, 2) }} · {{ $order->order_date }}</p>
                                </div>
                                <span class="text-xs font-semibold px-2 py-1 rounded-full
                                    {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-blue-100 text-blue-700' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        @empty
                            <p class="px-6 py-4 text-sm text-gray-400">No urgent orders at the moment.</p>
                        @endforelse
                    </div>

                    <div class="px-6 py-4 border-t border-gray-100">
                        <a href="{{ route('admin.orders.index') }}"
                            class="block w-full text-center px-4 py-2 bg-[#14213D] text-[#FCA311] text-sm font-semibold rounded hover:bg-[#FCA311] hover:text-[#14213D] transition">
                            View All Orders
                        </a>
                    </div>
                </div>

                {{-- Low Stock --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                        <div>
                            <h4 class="text-base font-bold text-[#14213D]">Low Stock Alert</h4>
                            <p class="text-xs text-gray-500 mt-0.5">Variants at or below 10 units</p>
                        </div>
                        @if ($lowStockCount > 0)
                            <span class="bg-red-100 text-red-600 text-xs font-bold px-2 py-1 rounded-full">
                                {{ $lowStockCount }} low
                            </span>
                        @else
                            <span class="bg-green-100 text-green-600 text-xs font-bold px-2 py-1 rounded-full">
                                All stocked
                            </span>
                        @endif
                    </div>

                    <div class="divide-y divide-gray-50">
                        @forelse ($lowStockVariants as $variant)
                            <div class="px-6 py-3 flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">
                                        <span class="text-red-500 mr-1">&#9888;</span>
                                        {{ $variant->product->name ?? 'Unknown' }}
                                    </p>
                                    <p class="text-xs text-gray-500">{{ $variant->size }} / {{ $variant->colour }}</p>
                                </div>
                                <span class="text-sm font-bold text-red-600">{{ $variant->stock_qty }} left</span>
                            </div>
                        @empty
                            <p class="px-6 py-4 text-sm text-gray-400">No low stock variants.</p>
                        @endforelse
                    </div>

                    <div class="px-6 py-4 border-t border-gray-100">
                        <a href="{{ route('admin.inventory.index') }}"
                            class="block w-full text-center px-4 py-2 bg-[#14213D] text-[#FCA311] text-sm font-semibold rounded hover:bg-[#FCA311] hover:text-[#14213D] transition">
                            View Inventory
                        </a>
                    </div>
                </div>

            </div>

            {{-- Recent Orders --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h4 class="text-base font-bold text-[#14213D]">Recent Orders</h4>
                    <p class="text-xs text-gray-500 mt-0.5">Last 5 orders placed</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500">Order ID</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500">Customer</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse ($recentOrders as $order)
                                <tr>
                                    <td class="px-6 py-3 text-sm text-gray-700">#{{ $order->order_id }}</td>
                                    <td class="px-6 py-3 text-sm text-gray-700">{{ $order->ship_name }}</td>
                                    <td class="px-6 py-3 text-sm text-gray-700">£{{ number_format($order->total_amount, 2) }}</td>
                                    <td class="px-6 py-3">
                                        <span class="text-xs font-semibold px-2 py-1 rounded-full
                                            {{ $order->status === 'pending'   ? 'bg-yellow-100 text-yellow-700' : '' }}
                                            {{ $order->status === 'paid'      ? 'bg-blue-100 text-blue-700'   : '' }}
                                            {{ $order->status === 'shipped'   ? 'bg-purple-100 text-purple-700' : '' }}
                                            {{ $order->status === 'completed' ? 'bg-green-100 text-green-700' : '' }}
                                            {{ $order->status === 'cancelled' ? 'bg-red-100 text-red-600'     : '' }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-3 text-sm text-gray-700">{{ $order->order_date }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-6 text-center text-sm text-gray-400">No orders yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-100">
                    <a href="{{ route('admin.orders.index') }}"
                        class="block w-full text-center px-4 py-2 bg-[#14213D] text-[#FCA311] text-sm font-semibold rounded hover:bg-[#FCA311] hover:text-[#14213D] transition">
                        View All Orders
                    </a>
                </div>
            </div>

        </div>
    </div>


</x-app-layout>
@include('components.footer')
