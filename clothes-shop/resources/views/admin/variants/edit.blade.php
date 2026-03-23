<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Edit Variant #{{ $variant->variant_id }}
            </h2>

            <a href="{{ route('admin.products.show', $variant->product_id) }}"
               class="inline-flex rounded border border-[#14213D] px-4 py-2 text-sm font-semibold text-[#14213D] hover:bg-[#14213D] hover:text-white transition">
                Back to Variants
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 rounded border border-green-200 bg-green-50 text-green-700 px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('admin.variants.update', $variant->variant_id) }}">
                    @csrf
                    @method('PUT')

                    <div class="grid gap-6 md:grid-cols-2">

                        <div>
                            <label class="block text-sm font-medium mb-1">Size</label>
                            <input type="text"
                                   name="size"
                                   value="{{ old('size', $variant->size) }}"
                                   required
                                   class="w-full rounded border-gray-300">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Colour</label>
                            <input type="text"
                                   name="colour"
                                   value="{{ old('colour', $variant->colour) }}"
                                   required
                                   class="w-full rounded border-gray-300">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Stock Quantity</label>
                            <input type="number"
                                   name="stock_qty"
                                   value="{{ old('stock_qty', $variant->stock_qty) }}"
                                   min="0"
                                   required
                                   class="w-full rounded border-gray-300">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Low Stock Threshold</label>
                            <input type="number"
                                   name="low_stock_threshold"
                                   value="{{ old('low_stock_threshold', $variant->low_stock_threshold) }}"
                                   min="0"
                                   required
                                   class="w-full rounded border-gray-300">
                        </div>

                    </div>

                    <div class="mt-8 flex items-center gap-3">
                        <button type="submit"
                                class="inline-flex rounded border border-[#14213D] px-4 py-2 text-sm font-semibold text-[#14213D] hover:bg-[#14213D] hover:text-white transition">
                            Save Changes
                        </button>

                        <a href="{{ route('admin.products.show', $variant->product_id) }}"
                           class="inline-flex rounded border border-[#14213D] px-4 py-2 text-sm font-semibold text-[#14213D] hover:bg-[#14213D] hover:text-white transition">
                            Cancel
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>

@include('components.footer')