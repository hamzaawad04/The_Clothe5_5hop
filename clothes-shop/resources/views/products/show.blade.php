@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10 max-w-md">

    <!-- Product Title -->
    <h1 class="text-4xl font-bold">{{ $product->name }}</h1>

    <!-- Price -->
    <p class="text-xl mt-4">£{{ $product->base_price }}</p>

    <!-- Description -->
    <p class="mt-6">{!! $product->description !!}</p>


    <!-- Add to Basket -->
<form action="{{ route('cart.add') }}" method="POST" class="mt-6">
    @csrf

    <!-- No variants yet, so store product_id -->
    <input type="hidden" name="variant_id" value="{{ $product->product_id }}">

    <div class="mt-4 flex items-center gap-3">
        <input 
            type="number" 
            name="qty" 
            value="1" 
            min="1" 
            class="border rounded px-3 py-2 w-20"
        >

        <button 
            type="submit"
            class="bg-black px-6 py-3 rounded-md hover:bg-gray-800 transition-all"
            style="color:#14213D;"
        >
            Add to Basket
        </button>
    </div>
</form>

    <div class="mt-4 flex items-center gap-3">
        <input 
            type="number" 
            name="qty" 
            value="1" 
            min="1" 
            class="border rounded px-3 py-2 w-20"
        >

        <button 
            type="submit"
            class="bg-black px-6 py-3 rounded-md hover:bg-gray-800 transition-all"
            style="color:#14213D;"
        >
            Add to Basket
        </button>
    </div>
</form>


    <!-- If the product has images -->
    @if($images->count())

    <div 
        x-data="{
            index: 0,
            images: {{ $images->pluck('url')->toJson() }}
        }"
        class="mt-6"
    >

        <div class="relative w-[300px] h-[300px] overflow-hidden rounded shadow">
            <img 
                :src="'/' + images[index]" 
                class="w-full h-full object-cover" 
            />

            <button 
                @click="index = (index - 1 + images.length) % images.length"
                class="absolute left-0 top-1/2 -translate-y-1/2 bg-black/60 text-white px-3 py-2 rounded-full"
            >
                ‹
            </button>

            <button 
                @click="index = (index + 1) % images.length"
                class="absolute right-0 top-1/2 -translate-y-1/2 bg-black/60 text-white px-3 py-2 rounded-full"
            >
                ›
            </button>
        </div>

        @if($images->count() > 1)
            <div class="flex gap-3 mt-4">
                @foreach($images as $i => $img)
                <div 
                    class="w-20 h-20 overflow-hidden rounded border cursor-pointer hover:ring-2"
                    @click="index = {{ $i }}"
                >
                    <img src="/{{ $img->url }}" class="w-full h-full object-cover">
                </div>
                @endforeach
            </div>
        @endif

    </div>
    @endif

</div>
@endsection
