<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Editing Product #{{ $product->product_id }}
            </h2>
            <a href="{{ route('admin.products.index') }}"
               class="inline-flex rounded border border-[#14213D] px-4 py-2 text-sm font-semibold text-[#14213D] hover:bg-[#14213D] hover:text-white transition">
                Back to Product Management
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.products.update', $product->product_id) }}">
                    @csrf
                    @method('PUT')
                    @include('admin.products.form', [
                        'product' => $product,
                        'categories' => $categories,
                        'submitLabel' => 'Save Changes',
                    ])
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

@include('components.footer')
