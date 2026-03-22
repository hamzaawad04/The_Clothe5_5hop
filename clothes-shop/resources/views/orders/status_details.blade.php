<x-app-layout :show-navigation="!request()->routeIs('admin.*')">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Order #{{ $order->order_id }}
        </h2>
    </x-slot>

    @php
    $statusClasses = match ($order->status) {
    'pending' => 'bg-amber-100 text-amber-800',
    'paid' => 'bg-blue-100 text-blue-800',
    'shipped' => 'bg-indigo-100 text-indigo-800',
    'completed' => 'bg-green-100 text-green-800',
    'cancelled' => 'bg-red-100 text-red-800',
    'return_requested' => 'bg-orange-100 text-orange-800',
    'return_accepted' => 'bg-teal-100 text-teal-800',
    'refunded' => 'bg-slate-100 text-slate-800',
    default => 'bg-gray-100 text-gray-800',
    };
    @endphp

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Placed on</p>
                        <p class="text-base font-semibold text-gray-900">{{ \Carbon\Carbon::parse($order->order_date)->format('d M Y, H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Order status</p>
                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $statusClasses }}">
                            {{ \Illuminate\Support\Str::of($order->status)->replace('_', ' ')->title() }}
                        </span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total amount</p>
                        <p class="text-base font-semibold text-gray-900">GBP {{ number_format($order->total_amount, 2) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-[#14213D] mb-4">Order Items</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700">Product</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700">Variant</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700">Qty</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700">Unit Price</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700">Line Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                            <tr class="border-t border-gray-200">
                                <td class="px-4 py-3 text-gray-900">{{ $item->product->name ?? 'Product unavailable' }}</td>
                                <td class="px-4 py-3 text-gray-700">
                                    Size: {{ $item->variant->size ?? 'N/A' }},
                                    Colour: {{ $item->variant->colour ?? 'N/A' }}
                                </td>
                                <td class="px-4 py-3 text-gray-700">{{ $item->qty }}</td>
                                <td class="px-4 py-3 text-gray-700">GBP {{ number_format($item->unit_price, 2) }}</td>
                                <td class="px-4 py-3 text-gray-700">GBP {{ number_format($item->line_total, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('orders.index') }}" class="inline-flex items-center rounded border border-[#14213D] px-4 py-2 text-sm font-semibold text-[#14213D] hover:bg-[#14213D] hover:text-white transition">
                    Back to Orders
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

@include('components.footer')
