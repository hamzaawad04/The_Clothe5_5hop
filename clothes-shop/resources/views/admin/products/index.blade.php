<x-app-layout :show-navigation="true">

    <x-slot name="sidebar">
        <x-admin-sidebar :activeItem="'products'" />
    </x-slot>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h1 class="text-3xl font-bold text-[#14213D]">Product Management</h1>
            <a href="{{ route('admin.products.create') }}"
                class="inline-flex items-center px-4 py-2 bg-[#14213D] text-[#FCA311] font-semibold rounded hover:bg-[#FCA311] hover:text-[#14213D] transition">
                Add Product
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 rounded border border-green-200 bg-green-50 text-green-700 px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-6 bg-white shadow-sm rounded-lg p-5">
                <form method="GET" action="{{ route('admin.products.index') }}" class="flex items-end gap-5">
                    <div class="w-72">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Product Name</label>
                        <input type="text" name="search"
                            value="{{ request('search') }}"
                            placeholder="Search product..."
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-[#14213D] focus:border-[#14213D]">
                    </div>

                    <div class="w-64">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                        <select name="category"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-[#14213D] focus:border-[#14213D]">
                            <option value="">All Categories</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->category_id }}"
                                    {{ request('category') == $category->category_id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

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
                            <th class="px-6 py-3 text-left text-m font-semibold text-gray-600">ID</th>
                            <th class="px-6 py-3 text-left text-m font-semibold text-gray-600">Product Name</th>
                            <th class="px-6 py-3 text-left text-m font-semibold text-gray-600">Category</th>
                            <th class="px-6 py-3 text-left text-m font-semibold text-gray-600">Price</th>
                            <th class="px-6 py-3 text-left text-m font-semibold text-gray-600">Primary Image</th>
                            <th class="px-6 py-3 text-left text-m font-semibold text-gray-600">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($products as $product)
                            @php
                                $primaryImage = $product->images->firstWhere('is_primary', 1) ?? $product->images->first();
                            @endphp

                            <tr class="hover:bg-gray-50">

                                <td class="px-6 py-4 text-sm text-gray-700">
                                    <a href="{{ route('admin.products.show', $product->product_id) }}"
                                        class="hover:underline font-semibold text-[#14213D]">
                                        {{ $product->product_id }}
                                    </a>
                                </td>

                                <td class="px-6 py-4">
                                    <p class="text-sm font-semibold text-gray-900">
                                        {{ $product->name }}
                                    </p>
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
                                        <img src="{{ $imageUrl }}"
                                            alt="{{ $product->name }}"
                                            class="h-12 w-12 rounded object-cover border border-gray-200">
                                    @else
                                        <span class="text-xs text-gray-500">No image</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('admin.products.edit', $product->product_id) }}"
                                            class="text-sm font-semibold text-[#14213D] hover:underline">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.products.destroy', $product->product_id) }}"
                                            method="POST">
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
                                <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-500">
                                    No products found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>


                <div class="mt-4 px-6 py-3 bg-white border-t border-gray-200">
                    {{ $products->withQueryString()->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

@include('components.footer')