<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Add Product
        </h2>
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
