<x-app-layout :show-navigation="false">
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Add Product
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
                <form method="POST" action="{{ route('admin.products.store') }}">
                    @csrf
                    @include('admin.products.form', [
                        'product' => null,
                        'categories' => $categories,
                        'submitLabel' => 'Add Product',
                    ])
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

@include('components.footer')
