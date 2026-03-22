<x-app-layout :show-navigation="true">

    <x-slot name="sidebar">
        <x-admin-sidebar :activeItem="'customers'" />
    </x-slot>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h1 class="text-3xl font-bold text-[#14213D]">Customer Details</h1>
            <div class="flex gap-2">
                <a href="{{ route('admin.customers.edit', $customer->user_id) }}"
                    class="inline-flex items-center px-4 py-2 bg-[#14213D] text-[#FCA311] font-semibold rounded hover:bg-[#FCA311] hover:text-[#14213D] transition">
                    Edit
                </a>
                <a href="{{ route('admin.customers.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-500 text-white font-semibold rounded hover:bg-gray-600 transition">
                    Back
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Customer Information Card -->
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h2 class="text-xl font-bold text-[#14213D] mb-4">Personal Information</h2>
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Name</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $customer->first_name }} {{ $customer->last_name }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Email</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $customer->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Phone</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $customer->phone ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Role</p>
                        <span class="inline-flex items-center rounded-full px-3 py-1 text-sm font-semibold {{ $customer->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ ucfirst($customer->role) }}
                        </span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Email Verification</p>
                        @if ($customer->email_verified_at)
                            <span class="inline-flex items-center rounded-full px-3 py-1 text-sm font-semibold bg-green-100 text-green-800">
                                ✓ Verified on {{ $customer->email_verified_at->format('M d, Y') }}
                            </span>
                        @else
                            <span class="inline-flex items-center rounded-full px-3 py-1 text-sm font-semibold bg-yellow-100 text-yellow-800">
                                Unverified
                            </span>
                        @endif
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Member Since</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $customer->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Customer Statistics Card -->
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h2 class="text-xl font-bold text-[#14213D] mb-4">Order Statistics</h2>
                <div class="grid grid-cols-4 gap-4">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-sm font-medium text-gray-600">Total Orders</p>
                        <p class="text-3xl font-bold text-[#14213D]">{{ $stats['total_orders'] }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-sm font-medium text-gray-600">Total Spent</p>
                        <p class="text-3xl font-bold text-[#14213D]">£{{ number_format($stats['total_spent'], 2) }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-sm font-medium text-gray-600">Avg Order Value</p>
                        <p class="text-3xl font-bold text-[#14213D]">£{{ number_format($stats['avg_order_value'], 2) }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-sm font-medium text-gray-600">Last Order</p>
                        <p class="text-lg font-bold text-[#14213D]">
                            @if ($stats['last_order'])
                                {{ $stats['last_order']->format('M d, Y') }}
                            @else
                                No orders
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Orders Table -->
            @if ($orders->isNotEmpty())
                <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-[#14213D]">Order History</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-m font-semibold text-gray-600">Order ID</th>
                                    <th class="px-6 py-3 text-left text-m font-semibold text-gray-600">Date</th>
                                    <th class="px-6 py-3 text-left text-m font-semibold text-gray-600">Items</th>
                                    <th class="px-6 py-3 text-left text-m font-semibold text-gray-600">Total</th>
                                    <th class="px-6 py-3 text-left text-m font-semibold text-gray-600">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-gray-700">#{{ $order->order_id }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ $order->created_at->format('M d, Y') }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ $order->items->count() }} items</td>
                                        <td class="px-6 py-4 text-sm font-semibold text-gray-700">£{{ number_format($order->total_amount, 2) }}</td>
                                        <td class="px-6 py-4 text-sm">
                                            <span class="inline-flex items-center rounded-full px-3 py-1 text-sm font-semibold
                                                {{ $order->status === 'pending' ? 'bg-amber-100 text-amber-800' : '' }}
                                                {{ $order->status === 'paid' ? 'bg-blue-100 text-blue-800' : '' }}
                                                {{ $order->status === 'shipped' ? 'bg-indigo-100 text-indigo-800' : '' }}
                                                {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $order->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}
                                                {{ $order->status === 'return_requested' ? 'bg-orange-100 text-orange-800' : '' }}
                                                {{ $order->status === 'return_accepted' ? 'bg-teal-100 text-teal-800' : '' }}
                                                {{ $order->status === 'refunded' ? 'bg-slate-100 text-slate-800' : '' }}">
                                                {{ \Illuminate\Support\Str::of($order->status)->replace('_', ' ')->title() }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="bg-white shadow-sm rounded-lg p-6 text-center text-gray-500">
                    <p>No orders found for this customer</p>
                </div>
            @endif

        </div>
    </div>

</x-app-layout>
