<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Returns & Refunds
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @if (session('success'))
                    <div class="mb-4 rounded-md border border-green-200 bg-green-50 p-3 text-sm text-green-800">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 rounded-md border border-red-200 bg-red-50 p-3 text-sm text-red-800">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($orders->isEmpty())
                    <div class="rounded-md border border-gray-200 bg-gray-50 p-4 text-gray-700">
                        No orders found.
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Order</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Date</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Items</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Total</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Status</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    @php
                                        $statusValue = $order->status->value;
                                        $statusClasses = match ($statusValue) {
                                            'Completed' => 'bg-green-100 text-green-800',
                                            'Return Requested' => 'bg-orange-100 text-orange-800',
                                            'Return Accepted' => 'bg-teal-100 text-teal-800',
                                            'Refunded' => 'bg-slate-100 text-slate-800',
                                            default => 'bg-gray-100 text-gray-800',
                                        };
                                    @endphp
                                    <tr class="border-t border-gray-200">
                                        <td class="px-4 py-3 font-medium text-gray-900">#{{ $order->order_id }}</td>
                                        <td class="px-4 py-3 text-gray-700">{{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}</td>
                                        <td class="px-4 py-3 text-gray-700">{{ $order->items_count }}</td>
                                        <td class="px-4 py-3 text-gray-700">GBP {{ number_format($order->total_amount, 2) }}</td>
                                        <td class="px-4 py-3">
                                            <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $statusClasses }}">
                                                {{ $statusValue }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            @if ($statusValue === 'Completed')
                                                <form method="POST" action="{{ route('orders.requestReturn', $order->order_id) }}" onsubmit="return confirm('Request return for this order?');">
                                                    @csrf
                                                    <button type="submit" class="inline-flex rounded border border-[#14213D] px-3 py-1 text-xs font-semibold text-[#14213D] hover:bg-[#14213D] hover:text-white transition">
                                                        Request Return
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-xs font-semibold text-gray-500">No action</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                <div class="mt-6">
                    <a href="{{ route('dashboard') }}" class="inline-flex rounded border border-[#14213D] px-4 py-2 text-sm font-semibold text-[#14213D] hover:bg-[#14213D] hover:text-white transition">
                        Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@include('components.footer')
