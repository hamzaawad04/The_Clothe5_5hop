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
                                                @foreach (['Pending','Paid','Shipped','Completed','Cancelled','Return Requested','Return Accepted','Refunded'] as $status)
                                                    <option value="{{ $status }}" @selected($order->status === $status)>
                                                        {{ $status }}
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


</x-app-layout>
@include('components.footer')
