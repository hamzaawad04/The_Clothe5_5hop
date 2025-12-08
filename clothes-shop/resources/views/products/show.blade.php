<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} – THE CLOTHE5 5HOP</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        body {
            font-family: "Playfair Display", serif;
            background: #fff;
        }
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 40px 20px;
            display: flex;
            gap: 50px;
        }
        .image-box {
            width: 450px;
        }
        .main-image {
            width: 100%;
            height: 450px;
            object-fit: contain;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,.15);
        }
        .thumbs {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }
        .thumbs img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            background: white;
            padding: 4px;   
        }
        .thumbs img:hover {
            border-color: #14213D;
        }
        .info-box {
            flex: 1;
        }
        .add-btn {
            background: #14213D;
            color: gold;
            padding: 12px 20px;
            border-radius: 6px;
            margin-top: 20px;
        }
        .popup {
            position: fixed;
            top: 20px;
            right: 20px;
            width: 260px;
            background: #fff;
            border: 1px solid #ddd;
            padding: 16px;
            border-radius: 8px;
            box-shadow: 0 4px 16px rgba(0,0,0,.2);
            z-index: 999;
        }
    </style>
</head>

<body>

@include('components.mainnavbar')

<div class="container">

    <!-- IMAGE SECTION -->
    <div class="image-box"
        x-data="{
            index: 0,
            images: {{ $images->pluck('url')->toJson() }}
        }"
    >
        <img :src="'/' + images[index]" class="main-image">

        @if($images->count() > 1)
            <div class="thumbs">
                @foreach($images as $i => $img)
                    <img 
                        src="/{{ $img->url }}" 
                        @click="index = {{ $i }}"
                    >
                @endforeach
            </div>
        @endif
    </div>

    <!-- PRODUCT INFO -->
    <div class="info-box">

        <h1 class="text-4xl font-bold">{{ $product->name }}</h1>

        <p class="text-2xl mt-3 font-semibold">£{{ number_format($product->base_price, 2) }}</p>

        <div class="mt-6 text-lg">
            {!! $product->description !!}
        </div>

        <!-- ADD TO BASKET FORM -->
        <form 
            x-data="addToCart()"
            @submit.prevent="submitForm"
            method="POST"
            action="{{ route('cart.add') }}"
        >
            @csrf

            <!-- VARIANT SELECT -->
            @if($product->variants->count() > 1)
                <label class="block mb-2 font-medium">Select Size:</label>
                <select 
                    name="variant_id"
                    x-model="variant_id"
                    class="border rounded px-3 py-2 w-48"
                >
                    @foreach($product->variants as $variant)
                        <option value="{{ $variant->variant_id }}">
                            {{ $variant->size }}
                            @if($variant->color) - {{ $variant->color }} @endif
                        </option>
                    @endforeach
                </select>
            @else
                <input 
                    type="hidden" 
                    name="variant_id"
                    value="{{ $product->variants->first()->variant_id }}"
                    x-model="variant_id"
                >
            @endif

            <!-- QUANTITY -->
            <div class="mt-4 flex items-center gap-4">
                <input 
                    type="number" 
                    name="qty" 
                    x-model="qty"
                    value="1"
                    min="1"
                    class="border rounded px-3 py-2 w-20"
                >

                <button 
                    type="submit" 
                    class="add-btn hover:bg-[#0f1829]"
                >
                    Add to Basket
                </button>
            </div>

            <!-- POPUP -->
            <div 
                x-show="showPopup"
                x-transition
                class="popup"
                style="display:none;"
            >
                <h3 class="font-bold text-lg">Added to Basket!</h3>
                <p class="text-gray-700 mt-1">{{ $product->name }}</p>
                <p class="text-gray-500 text-sm">Qty: <span x-text="qty"></span></p>

                <div class="flex justify-end gap-2 mt-4">
                    <a href="{{ route('cart.basket') }}" class="text-blue-600 underline text-sm">View Basket</a>
                    <button @click="showPopup = false" class="text-gray-600 text-sm">Close</button>
                </div>
            </div>

        </form>

    </div>
</div>

@include('components.footer')

<!-- ALPINE CART LOGIC -->
<script>
function addToCart() {
    return {
        variant_id: "{{ $product->variants->first()->variant_id }}",
        qty: 1,
        showPopup: false,

        async submitForm() {
            let formData = new FormData();
            formData.append("variant_id", this.variant_id);
            formData.append("qty", this.qty);

            const response = await fetch("{{ route('cart.add') }}", {
                method: "POST",
                headers: { 
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                },
                body: formData,
            });

            let result = await response.json();

            if (result.success) {
                this.showPopup = true;
                setTimeout(() => this.showPopup = false, 3000);
            }
        }
    }
}
</script>


</body>
</html>
