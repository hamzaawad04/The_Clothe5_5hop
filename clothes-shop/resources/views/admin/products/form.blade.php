<div class="grid gap-6 md:grid-cols-2">
    <div class="md:col-span-2">
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
        <input id="name"
               type="text"
               name="name"
               value="{{ old('name', $product?->name) }}"
               required
               class="w-full rounded border-gray-300 focus:border-[#14213D] focus:ring-[#14213D]">
    </div>

    <div class="md:col-span-2">
        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
        <textarea id="description"
                  name="description"
                  rows="6"
                  class="w-full rounded border-gray-300 focus:border-[#14213D] focus:ring-[#14213D]">{{ old('description', $product?->description) }}</textarea>
    </div>

    <div>
        <label for="base_price" class="block text-sm font-medium text-gray-700 mb-1">Base Price (&pound;)</label>
        <input id="base_price"
               type="number"
               name="base_price"
               value="{{ old('base_price', $product?->base_price) }}"
               step="0.01"
               min="0"
               required
               class="w-full rounded border-gray-300 focus:border-[#14213D] focus:ring-[#14213D]">
    </div>

    <!-- Stock and low stock threshold are now managed per variant -->

    <div class="md:col-span-2">
        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
        <select id="category_id"
                name="category_id"
                required
                class="w-full rounded border-gray-300 focus:border-[#14213D] focus:ring-[#14213D]">
            <option value="">Select category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->category_id }}"
                    @selected((string) old('category_id', $product?->category_id) === (string) $category->category_id)>
                    {{ $category->category_id }} - {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>
@php
    $primaryImage = old('primary_image_url', $product?->images?->firstWhere('is_primary', 1)?->url);
    $secondaryImage = old('secondary_image_url', $product?->images?->firstWhere('is_primary', 0)?->url);
@endphp
    <div>
        <label for="primary_image_url" class="block text-sm font-medium text-gray-700 mb-1">Primary Image Path</label>
        <input id="primary_image_url"
               type="text"
               name="primary_image_url"
               value="{{ $primaryImage }}"
               class="w-full rounded border-gray-300 focus:border-[#14213D] focus:ring-[#14213D]"
               placeholder="images/bottoms/jeansfront.png">
        <p class="mt-1 text-xs text-gray-500">Use a path relative to `public/` (for example `images/tops/example-front.png`).</p>
    </div>

    <div>
        <label for="secondary_image_url" class="block text-sm font-medium text-gray-700 mb-1">Secondary Image Path</label>
        <input id="secondary_image_url"
               type="text"
               name="secondary_image_url"
               value="{{ $secondaryImage }}"
               class="w-full rounded border-gray-300 focus:border-[#14213D] focus:ring-[#14213D]"
               placeholder="images/tops/example-back.png">
        <p class="mt-1 text-xs text-gray-500">Optional. Shown on mouse hover.</p>
    </div>
</div>

<div class="mt-8 flex items-center gap-3">
    <button type="submit"
            class="inline-flex rounded border border-[#14213D] px-4 py-2 text-sm font-semibold text-[#14213D] hover:bg-[#14213D] hover:text-white transition">
        {{ $submitLabel }}
    </button>
    <a href="{{ route('admin.products.index') }}"
       class="inline-flex rounded border border-[#14213D] px-4 py-2 text-sm font-semibold text-[#14213D] hover:bg-[#14213D] hover:text-white transition">
        Cancel
    </a>
</div>
