<x-app-layout :show-navigation="true">

    <x-slot name="sidebar">
        <x-admin-sidebar :activeItem="'orders'" />
    </x-slot>

    <x-slot name="header">
        <h1 class="text-3xl font-bold text-[#14213D]">Order Management</h1>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 rounded border border-green-200 bg-green-50 text-green-700 px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Filter Row -->
<div class="mb-6 bg-white shadow-sm rounded-lg p-5">
    <form method="GET" action="{{ route('admin.orders.index') }}" class="flex flex-wrap items-end gap-5">

        <!-- Search by Name -->
        <div class="w-64">
            <label class="block text-sm font-medium text-gray-700 mb-2">Customer Name</label>
            <input type="text" name="search"
                value="{{ request('search') }}"
                placeholder="Search by name..."
                class="w-full px-4 py-2.5 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-[#14213D] focus:border-[#14213D]">
        </div>

        <!-- Status Filter -->
        <div class="w-56">
            <label class="block text-sm font-medium text-gray-700 mb-2">Order Status</label>
            <select name="status"
                class="w-full px-4 py-2.5 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-[#14213D] focus:border-[#14213D]">
                <option value="">All Orders</option>
                @foreach ([
                    'Pending','Paid','Shipped','Completed',
                    'Cancelled','Return Requested',
                    'Return Accepted','Refunded'
                ] as $status)
                    <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>
                        {{ $status }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Date From -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">From</label>
            <input type="date" name="date_from"
                value="{{ request('date_from') }}"
                class="px-4 py-2.5 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-[#14213D] focus:border-[#14213D]">
        </div>

        <!-- Date To -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">To</label>
            <input type="date" name="date_to"
                value="{{ request('date_to') }}"
                class="px-4 py-2.5 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-[#14213D] focus:border-[#14213D]">
        </div>

        <!-- Filter Button -->
        <button type="submit"
            class="px-6 py-2.5 bg-[#14213D] text-[#FCA311] font-semibold rounded hover:bg-[#FCA311] hover:text-[#14213D] transition shadow-sm">
            Filter
        </button>

    </form>
</div>
            <div class="overflow-x-auto bg-white shadow-sm rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">ID</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Customer</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Total</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Date</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Update</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($orders as $order)
                            @php
                                $statusClasses = match ($order->status -> value) {
                                    'Pending' => 'bg-amber-100 text-amber-800',
                                    'Paid' => 'bg-blue-100 text-blue-800',
                                    'Shipped' => 'bg-indigo-100 text-indigo-800',
                                    'Completed' => 'bg-green-100 text-green-800',
                                    'Cancelled' => 'bg-red-100 text-red-800',
                                    'Return Requested' => 'bg-orange-100 text-orange-800',
                                    'Return Accepted' => 'bg-teal-100 text-teal-800',
                                    'Refunded' => 'bg-slate-100 text-slate-800',
                                    default => 'bg-gray-100 text-gray-800',
                                };
                            @endphp
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $order->order_id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $order->ship_name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">£{{ number_format($order->total_amount, 2) }}</td>
                                <td class="px-6 py-4 text-sm font-semibold">
                                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $statusClasses }}">
                                        {{ ($order->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $order->order_date }}</td>
                                <td class="px-6 py-4">
                                    <form method="POST" action="{{ route('admin.orders.updateStatus', $order->order_id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <div class="flex items-center gap-2">
                                            <select name="status" class="rounded border-gray-300 text-sm">
                                                @foreach (\App\OrderStatus::cases() as $status)
                                                    <option value="{{ $status->value }}" 
                                                        @selected($order->status -> value === $status -> value)>
                                                        {{ $status -> value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button type="submit"
                                                class="inline-flex rounded border border-[#14213D] px-3 py-1 text-xs font-semibold text-[#14213D] hover:bg-[#14213D] hover:text-white transition">
                                                Update
                                            </button>
                                            <a href="{{ route('admin.orders.show', $order->order_id) }}"
                                                class="inline-flex rounded border border-[#14213D] px-3 py-1 text-xs font-semibold text-[#14213D] hover:bg-[#14213D] hover:text-white transition">
                                                Order Details
                                            </a>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-500">
                                    No orders found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@if ($orders->hasPages())
    <div class="mt-6">
        {{ $orders->withQueryString()->links() }}
    </div>
@endif
</x-app-layout>

@include('components.footer')
