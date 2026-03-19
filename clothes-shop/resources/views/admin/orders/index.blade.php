<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            Order Management
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 rounded border border-green-200 bg-green-50 text-green-700 px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
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
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $order->order_id }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $order->ship_name}}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-700">
                                    £{{ number_format($order->total_amount, 2) }}
                                </td>

                                <td class="px-6 py-4 text-sm font-semibold">
                                    {{ ucfirst($order->status) }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $order->order_date }}
                                </td>

                                <td class="px-6 py-4">
                                    <form method="POST" action="{{ route('admin.orders.updateStatus', $order->order_id) }}">
                                        @csrf
                                        @method('PATCH')

                                        <div class="flex items-center gap-2">
                                            <select name="status" class="rounded border-gray-300 text-sm">
                                                @foreach (['pending','paid','shipped','completed','cancelled'] as $status)
                                                    <option value="{{ $status }}"
                                                        @selected($order->status === $status)>
                                                        {{ ucfirst($status) }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            <button type="submit"
                                                class="inline-flex rounded border border-[#14213D] px-3 py-1 text-xs font-semibold text-[#14213D] hover:bg-[#14213D] hover:text-white transition">
                                                Update
                                            </button>
                                            <a href="{{ route('admin.orders.show', $order->order_id) }}" class="inline-flex rounded border border-[#14213D] px-3 py-1 text-xs font-semibold text-[#14213D] hover:bg-[#14213D] hover:text-white transition">
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