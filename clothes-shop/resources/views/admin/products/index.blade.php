<x-app-layout :show-navigation="false">
    <x-admin-sidebar />

    <div class="py-10 ml-64">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 flex items-center justify-between">
                <h1 class="text-3xl font-bold text-[#14213D]">Product Management</h1>
                <a href="{{ route('admin.products.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-[#14213D] text-[#FCA311] font-semibold rounded hover:bg-[#FCA311] hover:text-[#14213D] transition">
                    Add Product
                </a>
            </div>

            @if (session('success'))
            <div class="mb-4 rounded border border-green-200 bg-green-50 text-green-700 px-4 py-3">
                {{ session('success') }}
            </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-m font-semibold text-gray-600">ID</th>
                            <th class="px-6 py-3 text-left text-m font-semibold text-gray-600">Product Name</th>
                            <th class="px-6 py-3 text-left text-m font-semibold text-gray-600">Category</th>
                            <th class="px-6 py-3 text-left text-m font-semibold text-gray-600">Price</th>
                            <th class="px-6 py-3 text-left text-m font-semibold text-gray-600">Primary Image</th>
                            <th class="px-6 py-3 text-left text-m font-semibold text-gray-600">Low Stock Threshold</th>
                            <th class="px-6 py-3 text-left text-m font-semibold text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($products as $product)
                        @php
                        $primaryImage = $product->images->firstWhere('is_primary', 1) ?? $product->images->first();
                        $categoryRoute = match ($product->category_id) {
                        1 => 'products.tops',
                        2 => 'products.bottoms',
                        3 => 'products.footwear',
                        4 => 'products.outerwear',
                        5 => 'products.accessories',
                        default => null,
                        };
                        @endphp
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $product->product_id }}</td>
                            <td class="px-6 py-4">
                                <p class="text-sm font-semibold text-gray-900">{{ $product->name }}</p>
                            </td>
                            <td class="px-6 py-4 font-semibold text-sm text-gray-700">
                                {{ $product->category?->name ?? 'Unknown' }}
                            </td>
                            <td class="px-6 py-4 font-semibold text-sm text-gray-700">
                                &pound;{{ number_format((float) $product->base_price, 2) }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($primaryImage)
                                @php
                                $imageUrl = \Illuminate\Support\Str::startsWith($primaryImage->url, ['http://', 'https://'])
                                ? $primaryImage->url
                                : asset($primaryImage->url);
                                @endphp
                                <img src="{{ $imageUrl }}" alt="{{ $product->name }}" class="h-12 w-12 rounded object-cover border border-gray-200">
                                @else
                                <span class="text-xs text-gray-500">No image</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-semibold text-sm text-gray-700">
                                N/A
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('admin.products.edit', $product->product_id) }}"
                                        class="text-sm font-semibold text-[#14213D] hover:underline">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product->product_id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-sm font-semibold text-red-500 hover:underline"
                                            onclick="return confirm('Delete this product?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-sm text-gray-500">
                                No products found.
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
