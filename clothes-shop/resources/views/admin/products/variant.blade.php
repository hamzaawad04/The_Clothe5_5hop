<x-app-layout :show-navigation="!request()->routeIs('admin.*')">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->name }} - Variants
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Product Info -->
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Product ID</p>
                        <p class="text-base font-semibold text-gray-900">
                            {{ $product->product_id }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Base Price</p>
                        <p class="text-base font-semibold text-gray-900">
                            GBP {{ number_format($product->base_price, 2) }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Category</p>
                        <p class="text-base font-semibold text-gray-900">
                            {{ $product->category->name ?? 'N/A' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Variants Table -->
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-[#14213D] mb-4">Product Variants</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700">Variant ID</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700">Size</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700">Colour</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700">Stock</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700">Price</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($product->variants as $variant)
                                <tr class="border-t border-gray-200">
                                    <td class="px-4 py-3 text-gray-900">
                                        {{ $variant->variant_id }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-700">
                                        {{ $variant->size ?? 'N/A' }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-700">
                                        {{ $variant->colour ?? 'N/A' }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-700">
                                        {{ $variant->stock_qty }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-700">
                                        GBP {{ number_format($variant->price ?? $product->base_price, 2) }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-3">
                                            <a href="{{ route('admin.variants.edit', $variant->variant_id) }}"
                                                class="text-sm font-semibold text-[#14213D] hover:underline">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.variants.destroy', $variant->variant_id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Delete this variant?')"
                                                    class="text-sm font-semibold text-red-500 hover:underline">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-3 text-center text-gray-500">
                                        No variants found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Back Button -->
            <div class="flex justify-end">
                <a href="{{ route('admin.products.index') }}"
                   class="inline-flex items-center rounded border border-[#14213D] px-4 py-2 text-sm font-semibold text-[#14213D] hover:bg-[#14213D] hover:text-white transition">
                    Back to Products
                </a>
            </div>

        </div>
    </div>
</x-app-layout>

@include('components.footer')